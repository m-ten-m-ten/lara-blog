<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Http\Controllers\Controller;
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
    public function showRegistrationForm(Admin $admin)
    {
        if (Admin::whereNotNull('email_verified_at')->count() >= 1) {
            return redirect(route('admin.login'))->with('status', '管理者はすでに登録済みです。');
        }

        if ($form = old() ?: session($this->sessionKey)) {
            $admin->fill($form);
        }

        return view('admin.signup.show', \compact('admin'));
    }

    /**
     * 検証
     */
    public function checkInput(Request $request)
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
            return redirect(route('admin.signup.show'));
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
            return redirect(route('admin.signup.show'));
        }

        event(new Registered($admin = $this->create($data)));

        auth('admin')->login($admin);

        session()->forget($this->sessionKey);

        return redirect(route('admin.index'));
    }

    protected function create(array $data)
    {
        return Admin::create([
            'email'    => $data['email'],
            'password' => $data['password'],
        ]);
    }
}
