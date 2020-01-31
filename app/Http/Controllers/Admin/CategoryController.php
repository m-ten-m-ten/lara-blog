<?php
/**
 * Laravelブログアプリのカテゴリー管理用コントローラー
 */

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryStoreRequest;
use Illuminate\Http\Request;

/**
 * Laravelブログアプリのカテゴリー管理用コントローラー
 *
 * LaravelブログアプリのカテゴリーのCRUDメソッド群を記載。
 */
class CategoryController extends Controller
{
    /**
     * 管理用カテゴリー一覧ページへアクセス
     *
     * @return response 管理用カテゴリー一覧ページを表示
     */
    public function index()
    {
        $data = [
            'categories' => Category::latest()->paginate(10),
        ];
        return view('admin.category.index', $data);
    }

    /**
     * 新規カテゴリー入力画面へアクセス
     *
     * @param Category $category カテゴリー
     *
     * @return Response 新規カテゴリー入力画面を表示
     */
    public function create(Category $category)
    {
        return view('admin.category.create', \compact('category'));
    }

    /**
     * 新規カテゴリーのレコード登録処理
     *
     * @param CategoryStoreRequest $request カテゴリーのFormRequest
     * @param Category $category カテゴリー
     *
     * @return Response カテゴリー編集画面へリダイレクト
     */
    public function store(CategoryStoreRequest $request, Category $category)
    {
        $category->fill($request->validated())->save();
        return redirect(route('admin.category.edit', $category))->with('status', '登録が完了しました。');
    }

    /**
     * カテゴリー編集画面へのアクセス
     *
     * @param Category $category カテゴリー
     *
     * @return Response カテゴリー編集画面へ遷移
     */
    public function edit(Category $category)
    {
        return view('admin.category.create', \compact('category'));
    }

    /**
     * カテゴリー編集内容のレコード更新処理
     *
     * @param CategoryStoreRequest $request カテゴリーフォームリクエスト
     * @param Category $category カテゴリー
     *
     * @return Response カテゴリー編集画面へリダイレクト
     */
    public function update(CategoryStoreRequest $request, Category $category)
    {
        $category->fill($request->validated())->save();
        return redirect(route('admin.category.edit', $category))->with('status', '変更が完了しました。');
    }

    /**
     * カテゴリーのレコード削除処理
     *
     * @param Request $request '$request->checked'に値が入っている時は複数削除で"checkedIds[]"が削除対象。
     *                         '$request->deleteId'に値が入っている時は個別削除で"deleteId"が削除対象。
     *
     * @return Response カテゴリー一覧へリダイレクト
     */
    public function delete(Request $request)
    {
        if ($request->checked) {
            Category::destroy($request->checkedIds);
        } elseif ($request->deleteId) {
            $category = Category::findOrFail($request->deleteId);
            $category->delete();
        }
        return redirect(route('admin.category.index'))->with('status', '削除が完了しました。');
    }
}
