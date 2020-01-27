<?php

namespace App\Http\Controllers\Stripe;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stripe\Charge;
use Stripe\Customer;
use Stripe\Stripe;

class CheckoutController extends Controller
{
    public function charge(Request $request)
    {
        try {
            Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

            $customer = Customer::create([
                'email'   => $request->stripeEmail,
                'source'  => $request->stripeToken,
            ]);

            $charge = Charge::create([
                'customer' => $customer->id,
                'amount'   => 500,
                'currency' => 'jpy',
            ]);

            return '成功！';
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
}
