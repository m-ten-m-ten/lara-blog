<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Auth\Events\Registered;
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
    public function show(User $user)
    {
        if ($form = old() ?: session($this->sessionKey)) {
            $user->fill($form);
        }

        return view('signup.show', \compact('user'));
    }

    /**
     * 検証
     */
    public function checkData(Request $request)
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
            return redirect(route('signup.show'));
        }
        $user->fill($data);

        return view('signup.confirm', \compact('user'));
    }

    /**
     * 登録処理等
     */
    public function store(User $user)
    {
        if (!$data = session($this->sessionKey)) {
            return redirect(route('signup.show'));
        }
        $data['status'] = 0;

        event(new Registered($user = $this->create($data)));

        auth('user')->login($user);

        session()->forget($this->sessionKey);

        return redirect(route('user.index'))->with('status', 'ユーザー登録が完了しました。');
    }

    protected function create(array $data)
    {
        $user = new User();
        $user->fill($data)->save();
        return $user;
    }
}
