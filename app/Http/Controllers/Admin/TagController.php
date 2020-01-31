<?php
/**
 * Laravelブログアプリのタグ管理用コントローラー
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TagStoreRequest;
use App\Tag;
use Illuminate\Http\Request;

/**
 * Laravelブログアプリのタグ管理用コントローラー
 *
 * LaravelブログアプリのタグのCRUDメソッド群を記載。
 */
class TagController extends Controller
{
    /**
     * 管理用タグ一覧ページへアクセス
     *
     * @return response 管理用タグ一覧ページを表示
     */
    public function index()
    {
        $data = [
            'tags' => Tag::latest()->paginate(10),
        ];
        return view('admin.tag.index', $data);
    }

    /**
     * 新規タグ入力画面へアクセス
     *
     * @param Tag $tag タグ
     *
     * @return Response 新規タグ入力画面を表示
     */
    public function create(Tag $tag)
    {
        return view('admin.tag.create', \compact('tag'));
    }

    /**
     * 新規タグのレコード登録処理
     *
     * @param TagStoreRequest $request タグのFormRequest
     * @param Tag $tag タグ
     *
     * @return Response タグ編集画面へリダイレクト
     */
    public function store(TagStoreRequest $request, Tag $tag)
    {
        $tag->fill($request->validated())->save();
        return redirect(route('admin.tag.edit', $tag))->with('status', '登録が完了しました。');
    }

    /**
     * タグ編集画面へのアクセス
     *
     * @param Tag $tag タグ
     *
     * @return Response タグ編集画面へ遷移
     */
    public function edit(Tag $tag)
    {
        return view('admin.tag.create', \compact('tag'));
    }

    /**
     * タグ編集内容のレコード更新処理
     *
     * @param TagStoreRequest $request タグフォームリクエスト
     * @param Tag $tag タグ
     *
     * @return Response タグ編集画面へリダイレクト
     */
    public function update(TagStoreRequest $request, Tag $tag)
    {
        $tag->fill($request->validated())->save();
        return redirect(route('admin.tag.edit', $tag))->with('status', '変更が完了しました。');
    }

    /**
     * タグのレコード削除処理
     *
     * @param Request $request '$request->checked'に値が入っている時は複数削除で"checkedIds[]"が削除対象。
     *                         '$request->deleteId'に値が入っている時は個別削除で"deleteId"が削除対象。
     *
     * @return Response タグ一覧へリダイレクト
     */
    public function delete(Request $request)
    {
        if ($request->checked) {
            foreach ($request->checkedIds as $id) {
                $tag = Tag::findOrFail($id);
                $tag->delete();
            }
        } elseif ($request->deleteId) {
            $tag = Tag::findOrFail($request->deleteId);
            $tag->delete();
        }
        return redirect(route('admin.tag.index'))->with('status', '削除が完了しました。');
    }
}
