<?php
/**
 * Laravelブログアプリの画像管理用コントローラー
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImageStoreRequest;
use App\Image;
use Illuminate\Http\Request;

/**
 * Laravelブログアプリの画像管理用コントローラー
 *
 * Laravelブログアプリの画像のCRUDメソッド群を記載。
 */
class ImageController extends Controller
{
    /**
     * 管理用画像一覧ページへアクセス
     *
     * @return response 管理用画像一覧ページを表示
     */
    public function index()
    {
        $data = [
            'images' => Image::latest()->paginate(10),
        ];
        return view('admin.image.index', $data);
    }

    /**
     * 新規画像入力画面へアクセス
     *
     * @param Image $image 画像
     *
     * @return Response 新規画像入力画面を表示
     */
    public function create(Image $image)
    {
        return view('admin.image.create', \compact('image'));
    }

    /**
     * 新規画像のレコード登録処理
     *
     * @param ImageStoreRequest $request 画像のFormRequest
     * @param Image $image 画像
     *
     * @return Response 画像編集画面へリダイレクト
     */
    public function store(ImageStoreRequest $request, Image $image)
    {
        $image->fill($request->validated())->save();
        return redirect(route('admin.image.edit', $image))->with('status', '登録が完了しました。');
    }

    /**
     * 画像編集画面へのアクセス
     *
     * @param Image $image 画像
     *
     * @return Response 画像編集画面へ遷移
     */
    public function edit(Image $image)
    {
        return view('admin.image.create', \compact('image'));
    }

    /**
     * 画像編集内容のレコード更新処理
     *
     * @param ImageStoreRequest $request 画像フォームリクエスト
     * @param Image $image 画像
     *
     * @return Response 画像編集画面へリダイレクト
     */
    public function update(ImageStoreRequest $request, Image $image)
    {
        $image->fill($request->validated())->save();
        return redirect(route('admin.image.edit', $image))->with('status', '変更が完了しました。');
    }

    /**
     * 画像のレコード削除処理
     *
     * @param Request $request '$request->checked'に値が入っている時は複数削除で"checkedIds[]"が削除対象。
     *                         '$request->deleteId'に値が入っている時は個別削除で"deleteId"が削除対象。
     *
     * @return Response 画像一覧へリダイレクト
     */
    public function delete(Request $request)
    {
        if ($request->checked) {
            foreach ($request->checkedIds as $id) {
                $image = Image::findOrFail($id);
                $image->delete();
            }
        } elseif ($request->deleteId) {
            $image = Image::findOrFail($request->deleteId);
            $image->delete();
        }
        return redirect(route('admin.image.index'))->with('status', '削除が完了しました。');
    }
}
