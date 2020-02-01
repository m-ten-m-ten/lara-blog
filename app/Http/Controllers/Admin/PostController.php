<?php

/**
 * Laravelブログアプリの投稿記事管理用コントローラー
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostStoreRequest;
use App\{Category, Image, Post, Tag};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * Laravelブログアプリの投稿記事管理用コントローラー
 */
class PostController extends Controller
{
    /**
     * 管理用投稿記事一覧ページへアクセスする。
     *
     * @return Resonse 管理用記事一覧ページを表示
     */
    public function index()
    {
        $posts = Post::getPostList();

        return view('admin.post.index', \compact('posts'));
    }

    /**
     * 新規投稿記事入力画面へアクセスする。
     *
     * @param Post $post 記事
     *
     * @return Response 投稿記事入力画面を表示
     */
    public function create(Post $post)
    {
        $data = [
            'post'          => $post,
            'images'        => Image::getImageList(),
            'categoryList'  => Category::getCategoryList(),
            'tagList'       => Tag::getTagList(),
        ];
        return view('admin.post.create', $data);
    }

    /**
     * 新規投稿記事の登録処理。
     *
     * @param PostStoreRequest $request 記事のFormRequest
     * @param Post $post 新規記事
     *
     * @return Response 投稿編集画面へリダイレクト
     */
    public function store(PostStoreRequest $request, Post $post)
    {
        $this->storeDateStatus($request->submit_btn, $post);

        if (isset($request->image_id)) {
            $this->storeThumbnail($request->image_id, $post);
        }
        $post->fill($request->validated())->save();
        $post->tags()->sync($request->tags);
        return redirect(route('admin.post.edit', $post))->with('status', '登録が完了しました。');
    }

    /**
     * 既存投稿記事の編集画面へのアクセス
     *
     * @param Post $post 記事
     *
     * @return Response 編集画面へアクセス
     */
    public function edit(Post $post)
    {
        $data = [
            'post'          => $post,
            'images'        => Image::getImageList(),
            'categoryList'  => Category::getCategoryList(),
            'tagList'       => Tag::getTagList(),
        ];
        return view('admin.post.create', $data);
    }

    /**
     * 既存投稿記事の更新処理
     *
     * @param PostStoreRequest $request 記事のFormRequest
     * @param Post $post 既存記事
     *
     * @return 投稿編集画面へリダイレクト
     */
    public function update(PostStoreRequest $request, Post $post)
    {
        $this->storeDateStatus($request->submit_btn, $post);

        if (isset($request->image_id)) {
            $this->storeThumbnail($request->image_id, $post);
        }
        $post->fill($request->validated())->save();
        $post->tags()->sync($request->tags);
        return redirect(route('admin.post.edit', $post))->with('status', '変更が完了しました。');
    }

    /**
     * 投稿記事の削除処理
     *
     * @param Request $request '$request->checked'に値が入っている時は複数削除で"checkedIds[]"が削除対象。
     *                         '$request->deleteId'に値が入っている時は個別削除で"deleteId"が削除対象。
     *
     * @return Response 管理用記事一覧ページへリダイレクト
     */
    public function delete(Request $request)
    {
        if ($request->checked) {
            foreach ($request->checkedIds as $deleteId) {
                $this->deletePost($deleteId);
            }
        } elseif ($request->deleteId) {
            $this->deletePost($request->deleteId);
        }
        return redirect(route('admin.post.index'))->with('status', '削除が完了しました。');
    }

    /**
     * 記事にサムネイル画像を登録する処理
     *
     * 既存のサムネイル画像があればファイル削除。
     * 登録する画像をs3のimgフォルダからthumbnailフォルダへ新ネームでコピー。
     * postにサムネイル関連のデータを登録。
     *
     * @param int $image_id 登録画像のid
     * @param Post $post 記事
     */
    public function storeThumbnail(Int $image_id, Post $post): void
    {
        $this->deleteThumbnail($post);

        $image = Image::find($image_id);
        $new_thumbnail = 'thumbnail_' . $post->id . '.' . $image->image_extension;
        Storage::disk('s3')->copy('img/' . $image->file_name, 'thumbnail/' . $new_thumbnail);

        $post->post_thumbnail = $new_thumbnail;
        $post->thumbnail_path = Storage::disk('s3')->url('thumbnail/' . $new_thumbnail);
        $post->save();
    }

    /**
     * 記事と関連ファイルの削除処理
     *
     * @param int $deleteId 記事のid
     */
    public function deletePost($deleteId): void
    {
        $post = Post::findOrFail($deleteId);
        $this->deleteThumbnail($post);
        $post->delete();
    }

    /**
     * 記事にサムネイル画像が登録されていれば、そのファイルを削除する。
     *
     * @param Post $post 記事
     */
    public function deleteThumbnail(Post $post): void
    {
        if (isset($post->post_thumbnail)) {
            Storage::disk('s3')->delete('thumbnail/' . $post->post_thumbnail);
        }
    }

    /**
     * 記事作成のTinyMce（WYSIWYGエディタ）用の画像JSONデータ出力処理
     *
     * @return JSON
     */
    public function readImage()
    {
        $images = Image::latest()->get();

        $imageJSON = $images->map(function ($image) {
            return ['title' => $image->file_name, 'value' => $image->path];
        });

        return $imageJSON;
    }
}
