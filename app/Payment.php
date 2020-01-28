<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    /**
     * クレジットカード登録処理
     *
     * @param string $token payment.jsにて処理された'stripeToken'
     * @param User $user ログイン中のユーザー
     */
    public static function saveCustomer(String $token, User $user): void
    {
        \Stripe\Stripe::setApiKey(\Config::get('payment.stripe_secret_key'));

        if ($user->stripe_id) { //顧客登録済みの場合
            self::deleteCard($user); //既存のカードがあれば削除
            $customer = \Stripe\Customer::retrieve($user->stripe_id);
            $newCard = $customer->sources->create(['source' => $token]); //新しいカードを作成
            $customer->default_source = $newCard['id']; //デフォルトカードとして登録
            $customer->save();
        } else { //顧客未登録の場合
            $customer = \Stripe\Customer::create([
                'card'        => $token,
                'name'        => $user->name,
                'description' => $user->id,
            ]);
            $user->stripe_id = $customer->id;
            $user->save();
        }
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
     * 顧客の登録カード情報を削除
     *
     * @param User $user 該当ユーザー
     */
    protected static function deleteCard(User $user): void
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
