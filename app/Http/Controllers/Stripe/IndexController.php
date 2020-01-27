<?php

namespace App\Http\Controllers\Stripe;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    /**
     * Stripe画面TOPを表示
     */
    public function index()
    {
        return view('stripe.index');
    }
}
