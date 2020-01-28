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
            return redirect(route('user.payment.top'));
        }

        try {
            if ($user->stripe_id) { //顧客登録済みの場合
                Payment::updateCustomer($token, $user);
            } else { //顧客未登録の場合
                Payment::setCustomer($token, $user);
            }
        } catch (\Stripe\Exception\CardException $e) {
            /*
             * カード登録失敗時には現段階では一律で別の登録カードを入れていただくように
             * 促すメッセージで統一。
             * カードエラーの類としては以下があるとのこと
             * １、カードが決済に失敗しました
             * ２、セキュリティーコードが間違っています
             * ３、有効期限が間違っています
             * ４、処理中にエラーが発生しました
             *  */
            $cardError = [
                'cardError' => 'カード登録に失敗しました。入力いただいた内容に相違がないかを確認いただき、問題ない場合は別のカードで登録を行ってみてください。',
            ];
            return redirect(route('user.payment.create'))->withErrors($cardError);
        }

        return redirect(route('user.payment.top'))->with('status', 'カード情報の登録が完了しました。');
    }

    /**
     * クレジットカード削除処理
     *
     * @return クレジットカード情報表示画面へリダイレクト
     */
    public function delete(Request $request)
    {
        $user = $request->user();

        $result = Payment::deleteCard($user);

        if ($result) {
            return redirect(route('user.payment.top'))->with('status', 'カード情報の削除が完了しました。');
        }
        return redirect(route('user.payment.top'));
    }
}
