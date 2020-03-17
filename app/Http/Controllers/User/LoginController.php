<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * ログイン後のリダイレクト先
     */
    public function redirectTo()
    {
        return route('user.index');
    }

    /**
     * ログイン画面のviewの指定
     */
    public function showLoginForm()
    {
        return view('user.login');
    }

    /**
     * ログアウト処理
     */
    public function logout(Request $request)
    {
        $partialLogin = auth('user')->guest() || auth('admin')->guest();

        $this->guard()->logout();

        // どちらか片方のみでログインしている時のみ、invalidate する
        if ($partialLogin) {
            $request->session()->invalidate();
        }

        return redirect(route('user.login'));
    }

    /**
     * バリデーションを行う（メッセージの日本語化）
     */
    protected function validateLogin(Request $request): void
    {
        $messages = [
            'email.required'    => 'メールアドレスを入力して下さい。',
            'password.required' => 'パスワードを入力して下さい。',
        ];

        $request->validate([
            'email'    => 'required|string',
            'password' => 'required|string',
        ], $messages);
    }

    /**
     * 使用する認証を返す
     */
    protected function guard()
    {
        return auth('user');
    }
}
