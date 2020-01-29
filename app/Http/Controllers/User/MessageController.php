<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * 自分宛のメッセージ一覧表示
     */
    public function index(Request $request)
    {
        $messages = auth()->user()->messages()->latest()->get();

        return view('user.message.index', \compact('messages'));
    }

    /**
     * 自分宛のメッセージの詳細表示
     * MessagePolicyのviewポリシーを、ルーティングでmiddlewareにて設定済み。
     */
    public function show(Message $message)
    {
        return view('user.message.show', \compact('message'));
    }
}
