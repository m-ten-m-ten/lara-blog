<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SubscribeController extends Controller
{
    /**
     * 定期決済の作成と有料会員登録処理
     *
     * @return お支払い情報ページへリダイレクト
     */
    public function create(Request $request)
    {
        \Stripe\Stripe::setApiKey(config('services.stripe.secret'));
        $user = $request->user();

        try {
            $subscription = \Stripe\Subscription::create([
                'customer' => $user->stripe_id,
                'items'    => [['plan' => config('services.stripe.plan')]],
            ]);
        } catch (\Stripe\Exception\CardException $e) {
            $subscriptionError = [
                'subscriptionError' => '有料会員登録に失敗しました。時間をあけて再度お試し下さい。',
            ];
            return redirect(route('user.payment.index'))->withErrors($subscriptionError);
        }
        $user->subscription_id = $subscription->id;
        $user->status = 1;
        $user->save();

        return redirect(route('user.payment.index'))->with('status', '定期支払の登録及び有料会員登録が完了致しました。');
    }

    /**
     * 定期決済の削除と、有料会員登録の解除処理
     *
     * @return お支払い情報ページへリダイレクト
     */
    public function delete(Request $request)
    {
        \Stripe\Stripe::setApiKey(config('services.stripe.secret'));
        $user = $request->user();

        try {
            $subscription = \Stripe\Subscription::retrieve($user->subscription_id);
            $subscription->delete();
        } catch (\Stripe\Exception\CardException $e) {
            $subscriptionError = [
                'subscriptionError' => '有料会員登録の解除に失敗しました。時間をあけて再度お試し下さい。',
            ];
            return redirect(route('user.payment.index'))->withErrors($subscriptionError);
        }

        $user->subscription_id = null;
        $user->status = 0;
        $user->save();

        return redirect(route('user.payment.index'))->with('status', '定期支払の登録及び有料会員登録が完了致しました。');
    }
}
