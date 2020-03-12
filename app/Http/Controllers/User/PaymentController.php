<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * クレジットカード登録情報を表示
     *
     * @return クレジットカード登録情報画面を表示
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $defaultCard = Payment::getDefaultcard($user);
        return view('user.payment.index', \compact('user', 'defaultCard'));
    }

    /**
     * クレジットカード情報入力画面を表示
     *
     * @return Response
     */
    public function create()
    {
        return view('user.payment.create');
    }

    /**
     * クレジットカード登録処理
     *
     * @param Request $request payment.jsにて処理された'stripeToken'が送られてくる
     *
     * @return カード登録完了後支払いトップへリダイレクト。'stripeToken'がなければ支払いトップヘ、カード登録エラーがあればフォームへリダイレクト。
     */
    public function store(Request $request)
    {
        $token = $request->stripeToken;
        $user = $request->user();

        if (!$token) {
            $errors = 'エラーが発生しました。通信状況の良い場所で再度ご登録をしていただくか、しばらく立ってから再度登録を行ってみてください。';
            return redirect(route('user.payment.index'));
        }

        try {
            Payment::saveCustomer($token, $user);
        } catch (\Stripe\Exception\CardException $e) {
            $cardError = [
                'cardError' => 'カードの登録に失敗しました。ご入力内容にお間違えがない場合は、別のカードでお試し願います。',
            ];
            return redirect(route('user.payment.create'))->withErrors($cardError);
        }

        return redirect(route('user.payment.index'))->with('status', 'カード情報の登録が完了しました。');
    }

    /**
     * クレジットカード削除処理
     *
     * @return クレジットカード情報表示画面へリダイレクト
     */
    public function delete(Request $request)
    {
        $user = $request->user();
        Payment::deleteCard($user);
        return redirect(route('user.payment.index'))->with('status', 'カード情報の削除が完了しました。');
    }
}
