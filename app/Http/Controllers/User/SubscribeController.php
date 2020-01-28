<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SubscribeController extends Controller
{
    /**
     * 定期決済の登録処理
     *
     * @param Request $request [description]
     *
     * @return [type] [description]
     */
    public function create(Request $request)
    {
        \Stripe\Stripe::setApiKey(\Config::get('payment.stripe_secret_key'));
        $user = $request->user();

        try {
            \Stripe\Subscription::create([
                'customer' => $user->stripe_id,
                'items'    => [['plan' => 'plan_GbSICtC7pUiZlD']],
            ]);
        } catch (\Stripe\Exception\CardException $e) {
            return redirect(route('user.payment.top'));
        }

        $user->status = 1;
        $user->save();

        return redirect(route('user.payment.top'))->with('status', '定期支払の登録及び有料会員登録が完了致しました。');
    }
}
