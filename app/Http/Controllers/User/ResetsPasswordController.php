<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ResetsPasswordController extends Controller
{
    use ResetsPasswords;

    /**
     *パスワードリセットに使われるブローカの取得
     *
     * @return PasswordBroker
     */
    public function broker()
    {
        return Password::broker('users');
    }

    /**
     * パスワードリセットの間、使用されるガードの取得
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('user');
    }

    protected $redirectTo = '/user/login';

        /**
     * Display the password reset view for the given token.
     *
     * If no token is present, display the link request form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string|null  $token
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showResetForm(Request $request, $token = null)
    {
        return view('user.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }
}
