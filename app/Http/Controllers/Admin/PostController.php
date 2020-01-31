<?php

/**
 * Laravelブログアプリの投稿記事管理用コントローラー
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostStoreRequest;
use App\{Category, Image, Post, Tag};
use Carbon\Carbon;
use Illuminate\Http\Request;

/**
 * Laravelブログアプリの投稿記事管理用コントローラー
 *
 * Laravelブログアプリの投稿記事のCRUDメソッド群を記載。
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
     * 新規記事投稿画面及び既存記事編集画面にて、押されたボタンによりステータスの更新及び日付の更新を行う
     *
     * 「下書き」ボタン：記事ステータス'post_status'を下書き'drafted'にして、下書き保存日時'post_drafted'に現時刻を入れる。
     * 「公開」ボタン：記事ステータス'post_status'を公開'published'にして、公開日時'post_published'に現時刻を入れる。
     * 「更新」ボタン：記事ステータス'post_status'を公開'published'にして、更新日時'post_modified'に現時刻を入れる。
     *
     * @param string $submit_btn 押下ボタンの種類。下書き'draft_btn',公開'publish_btn',更新'modify_btn'。
     * @param Post $post 記事
     */
    public function storeDateStatus(String $submit_btn, Post $post): void
    {
        switch ($submit_btn) {
            case 'draft_btn':
              $post->post_drafted = Carbon::now();
              $post->post_status = 'drafted';
              break;
            case 'publish_btn':
              $post->post_published = Carbon::now();
              $post->post_status = 'published';
              break;
            case 'modify_btn':
              $post->post_modified = Carbon::now();
              $post->post_status = 'published';
              break;
            default:
              break;
        }
    }

    /**
     * 記事にサムネイル画像を登録する処理
     *
     * 登録済みのサムネイル画像を削除し、ファイル名を'現時刻thumbnail_ポストid.ファイル拡張子'としてpublic/thumbnailフォルダにコピーする。
     * 記事のpost_thumbnailにファイル名を登録する。
     *
     * @param int $image_id 登録したい画像のid
     * @param Post $post 記事
     */
    public function storeThumbnail(Int $image_id, Post $post): void
    {
        $this->deleteThumbnail($post);
        $image = Image::find($image_id);
        $now = Carbon::now()->format('YmdHis');
        $file_name = $now . 'thumbnail_' . $post->id . '.' . $image->image_extension;
        $source = public_path() . '/img/' . $image->image_name . '.' . $image->image_extension;
        $dest = public_path() . '/thumbnail/' . $file_name;
        \copy($source, $dest);
        $post->post_thumbnail = $file_name;
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
     * サムネイル画像ファイルの削除処理
     *
     * 記事にサムネイル画像が登録されていれば、そのファイルを削除する。
     *
     * @param Post $post 記事
     */
    public function deleteThumbnail(Post $post): void
    {
        if (isset($post->post_thumbnail)) {
            \unlink(public_path() . '/thumbnail/' . $post->post_thumbnail);
        }
    }

    /**
     * 投稿記事本文入力欄のTinyMce（WYSIWYGエディタ）用の画像JSONデータ出力処理
     *
     * @return array 画像ファイル名・画像パスの配列
     */
    public function readImage(): array
    {
        $images = Image::latest()->get();
        $imageJSON = [];

        foreach ($images as $image) {
            $fileName = $image->image_name . '.' . $image->image_extension;
            $imageJSON[] = ['title' => $fileName, 'value' => '/img/' . $fileName];
        }
        return $imageJSON;
    }
}
