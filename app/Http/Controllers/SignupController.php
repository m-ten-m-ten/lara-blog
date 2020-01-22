<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class SignupController extends Controller
{
    /**
     * 検証済みデータ格納用セッションキー
     */
    protected $sessionKey = 'SignupData';

    /**
     * 登録画面
     */
    public function index(User $user)
    {
        if ($form = old() ?: session($this->sessionKey)) {
            $user->fill($form);
        }

        return view('signup.index', \compact('user'));
    }

    /**
     * 検証
     */
    public function postIndex(Request $request)
    {
        $validatedData = $request->validate([
            'name'     => 'required|max:255',
            'email'    => 'required|max:255|email:filter|unique:users',
            'password' => 'required|confirmed|between:8,30|regex:/^[!-~]+$/',
        ]);

        $validatedData['password'] = bcrypt($validatedData['password']);

        session([$this->sessionKey => $validatedData]);

        return redirect(route('signup.confirm'));
    }

    /**
     * 確認画面
     */
    public function confirm(User $user)
    {
        if (!$data = session($this->sessionKey)) {
            return redirect(route('signup.index'));
        }

        $user->fill($data);

        return view('signup.confirm', \compact('user'));
    }

    /**
     * 登録処理等
     */
    public function postConfirm(User $user)
    {
        if (!$data = session($this->sessionKey)) {
            return redirect(route('signup.index'));
        }

        $user->fill($data)->save();

        auth('user')->login($user);

        session()->forget($this->sessionKey);

        return redirect(route('signup.thanks'))->with('status', 'ユーザー登録が完了しました。');
    }

    /**
     * 完了画面
     */
    public function thanks()
    {
        return view('signup.thanks');
    }
}
