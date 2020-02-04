<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * ユーザー一覧
     */
    public function index(Request $request)
    {
        $users = User::latest()->withCount('messages')->paginate(10);

        return view('admin.user.index', \compact('users'));
    }

    /**
     * ユーザーの削除
     *
     * @param Request $request '$request->checked'に値が入っている時は複数削除で"checkedIds[]"が削除対象。
     *                         '$request->deleteId'に値が入っている時は個別削除で"deleteId"が削除対象。
     *
     * @return Response ユーザー一覧へリダイレクト
     */
    public function delete(Request $request)
    {
        if ($request->checked) {
            User::destroy($request->checkedIds);
        } elseif ($request->deleteId) {
            $user = User::findOrFail($request->deleteId);
            $user->delete();
        }
        return redirect(route('admin.user.index'))->with('status', '削除が完了しました。');
    }
}
