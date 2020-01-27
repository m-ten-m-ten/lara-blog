<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SubscribeController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        return view('user.subscribe.index', \compact('user'));
    }

    public function subscribe_process(Request $request)
    {
        try {
            Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

            $user = $request->user();
            $user->newSubscription('default', 'plan_GbSICtC7pUiZlD')->create($request->stripeToken);

            return redirect(route('subscribe.top'))->with('status', '定期支払処理が完了しました。');
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }
}
