<?php
/**
 * Laravelブログアプリの画像管理用コントローラー
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImageStoreRequest;
use App\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
     *
     * @return Response 画像編集画面へリダイレクト
     */
    public function store(ImageStoreRequest $request)
    {
        $image_files = $request->validated()['image_files'];

        foreach ($image_files as $index => $image_file) {
            $image = new Image();
            $file_name = $image_file->getClientOriginalName();
            $image->file_name = $file_name;
            Storage::disk('s3')->putFileAs('/img', $image_file, $file_name, 'public');
            $image->path = Storage::disk('s3')->url('img/' . $file_name);
            $image->save();
        }
        return redirect(route('admin.image.index'))->with('status', '登録が完了しました。');
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
                $this->deleteImage($id);
            }
        } elseif ($request->deleteId) {
            $this->deleteImage($request->deleteId);
        }

        return redirect(route('admin.image.index'))->with('status', '削除が完了しました。');
    }

    /**
     * 画像の削除処理
     *
     * @param int $id 削除したい画像ID
     */
    public function deleteImage(Int $id): void
    {
        $image = Image::findOrFail($id);
        Storage::disk('s3')->delete('img/' . $image->file_name);
        $image->delete();
    }
}
