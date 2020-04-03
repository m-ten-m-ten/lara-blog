<?php

namespace App\Http\Controllers\Contact;

use App\Admin;
use App\Http\Controllers\Controller;
use App\Mail\ContactSendToAdmin;
use App\Mail\ContactSendToCustomer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * 検証済みデータ格納用セッションキー
     */
    protected $sessionKey = 'ContactData';

    public function show()
    {
        $contact = old() ?: session($this->sessionKey);

        return view('contact.show', \compact('contact'));
    }

    /**
     * 入力値検証
     */
    public function checkInput(Request $request)
    {
        $validatedData = $request->validate([
            'name'  => 'required|max:50',
            'email' => 'nullable|max:255|email:filter',
            'body'  => 'required|max:1000',
        ]);

        session([$this->sessionKey => $validatedData]);

        return redirect(route('contact.confirm'));
    }

    /**
     * 確認画面
     */
    public function confirm()
    {
        if (!$contact = session($this->sessionKey)) {
            return redirect(route('contact.show'));
        }

        return view('contact.confirm', \compact('contact'));
    }

    /**
     * 管理者へお問い合わせ内容の送信
     */
    public function send()
    {
        if (!$contact = session($this->sessionKey)) {
            return redirect(route('contact.show'));
        }

        $admin = Admin::whereNotNull('email_verified_at')->first();

        Mail::to($admin)->send(new ContactSendToAdmin($contact));

        if ($contact['email']) {
            Mail::to($contact['email'])->send(new ContactSendToCustomer($contact));
        }

        session()->forget($this->sessionKey);

        return redirect(route('contact.thanks'));
    }

    /**
     * お問い合わせ完了画面
     */
    public function thanks()
    {
        return view('contact.thanks');
    }
}
