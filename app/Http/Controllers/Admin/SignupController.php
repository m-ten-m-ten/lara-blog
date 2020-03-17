<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin;

class SignupController extends Controller
{
    /**
     * 検証済みデータ格納用セッションキー
     */
    protected $sessionKey = 'SignupData';

    /**
     * 登録画面
     */
    public function create(Admin $admin)
    {
        if (Admin::count() >= 1){
            return redirect(route('admin.login'))->with('status', '管理者はすでに登録済みです。');
        }

        if ($form = old() ?: session($this->sessionKey)) {
            $admin->fill($form);
        }

        return view('admin.signup.create', \compact('admin'));
    }

    /**
     * 検証
     */
    public function checkData(Request $request)
    {
        $validatedData = $request->validate([
            'email'    => 'required|max:255|email:filter|unique:admins',
            'password' => 'required|confirmed|between:8,30|regex:/^[!-~]+$/',
        ]);

        $validatedData['password'] = bcrypt($validatedData['password']);

        session([$this->sessionKey => $validatedData]);

        return redirect(route('admin.signup.confirm'));
    }

    /**
     * 確認画面
     */
    public function confirm(Admin $admin)
    {
        if (!$data = session($this->sessionKey)) {
            return redirect(route('admin.signup.create'));
        }
        $admin->fill($data);

        return view('admin.signup.confirm', \compact('admin'));
    }

    /**
     * 登録処理等
     */
    public function store(Admin $admin)
    {
        if (!$data = session($this->sessionKey)) {
            return redirect(route('admin.signup.create'));
        }
        $admin->fill($data)->save();

        auth('admin')->login($admin);

        session()->forget($this->sessionKey);

        return redirect(route('admin.index'))->with('status', '管理者登録が完了しました。');
    }
}
