<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    /**
     * Stripe上に「顧客」を登録するための関数
     *
     * @param object $user ・・・・・カード登録をするユーザーの情報
     */
    public static function setCustomer(String $token, User $user)
    {
        \Stripe\Stripe::setApiKey(\Config::get('payment.stripe_secret_key'));

        //Stripe上に顧客情報をtokenを使用することで保存
        try {
            $customer = \Stripe\Customer::create([
                'card'        => $token,
                'name'        => $user->name,
                'description' => $user->id,
            ]);
        } catch (\Stripe\Exception\CardException $e) {
            /*
             * カード登録失敗時には現段階では一律で別の登録カードを入れていただくように
             * 促すメッセージで統一。
             * カードエラーの類としては以下があるとのこと
             * １、カードが決済に失敗しました
             * ２、セキュリティーコードが間違っています
             * ３、有効期限が間違っています
             * ４、処理中にエラーが発生しました
             *  */
            return false;
        }
        $user->stripe_id = $customer->id;
        $user->save();
        return true;
    }

    /**
     * Stripe上の「顧客」情報を更新するための関数
     *
     * @param object $user ・・・・・カード登録をするユーザーの情報
     */
    public static function updateCustomer(String $token, User $user)
    {
        \Stripe\Stripe::setApiKey(\Config::get('payment.stripe_secret_key'));

        try {
            self::deleteCard($user); //既存のカードがあれば削除
            $customer = \Stripe\Customer::retrieve($user->stripe_id);
            $newCard = $customer->sources->create(['source' => $token]); //新しいカードを作成
            $customer->default_source = $newCard['id']; //デフォルトカードとして登録
            $customer->save();
        } catch (\Stripe\Exception\CardException $e) {
            /*
             * カード登録失敗時には現段階では一律で別の登録カードを入れていただくように
             * 促すメッセージで統一。（メッセージ自体はController側で制御しています）
             * カードエラーの類としては
             * １、カードが決済に失敗しました
             * ２、セキュリティーコードが間違っています
             * ３、有効期限が間違っています
             * ４、処理中にエラーが発生しました
             *  */
            return false;
        }
        return true;
    }

    /**
     * Stripe上に現在登録されている顧客の「使用カード」の情報を取得するための関数
     *
     * @param object $user ・・・・・カード登録をするユーザーの情報
     */
    protected static function getDefaultcard(User $user)
    {
        \Stripe\Stripe::setApiKey(\Config::get('payment.stripe_secret_key'));

        $default_card = null;

        if ($user->stripe_id !== null) {
            $customer = \Stripe\Customer::retrieve($user->stripe_id);

            if (isset($customer['default_source']) && $customer['default_source']) {
                $card = $customer->sources->data[0];
                $default_card = [
                    'number'    => \str_repeat('*', 8) . $card->last4,
                    'brand'     => $card->brand,
                    'exp_month' => $card->exp_month,
                    'exp_year'  => $card->exp_year,
                    'name'      => $card->name,
                    'id'        => $card->id,
                ];
            }
        }
        return $default_card;
    }

    /**
     * Stripe上に現在登録されている顧客のカード情報を削除するための関数
     *
     * @param object $user ・・・・・カード削除をするユーザーの情報
     */
    protected static function deleteCard($user): void
    {
        \Stripe\Stripe::setApiKey(\Config::get('payment.stripe_secret_key'));
        $customer = \Stripe\Customer::retrieve($user->stripe_id);

        // card情報が存在していれば削除
        if (isset($customer->sources->data[0])) {
            \Stripe\Customer::deleteSource(
                $user->stripe_id,
                $customer->sources->data[0]->id
            );
        }
    }
}
