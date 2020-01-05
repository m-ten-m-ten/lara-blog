<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostStoreRequest;
use App\{Category, Image, Tag, post};
use Carbon\Carbon;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->paginate(10);
        return view('dashboard.post.index', \compact('posts'));
    }

    public function create(Post $post)
    {
        $data = [
            'post'       => $post,
            'images'     => Image::latest()->paginate(15),
            'categories' => Category::all(),
            'tags'       => Tag::all(),
        ];
        return view('dashboard.post.create', $data);
    }

    public function store(PostStoreRequest $request, Post $post)
    {
        $this->storeDateStatus($request->submit_btn, $post); //post_statusと各日付の更新。
    $post->tags()->sync($request->tags); //タグの更新。
    if (isset($request->image_id)) {
        $this->storeThumbnail($request->image_id, $post);
    } //サムネイル画像の登録があれば、更新。
    $post->fill($request->validated())->save(); //その他の検証済みのデータもfillして、セーブ。
    return redirect(route('post.edit', $post));
    }

    public function edit(Post $post)
    {
        $data = [
            'post'       => $post,
            'images'     => Image::latest()->paginate(15),
            'categories' => Category::all(),
            'tags'       => Tag::all(),
        ];
        return view('dashboard.post.create', $data);
    }

    public function update(PostStoreRequest $request, Post $post)
    {
        $this->storeDateStatus($request->submit_btn, $post); //post_statusと各日付の更新
    $post->tags()->sync($request->tags); //タグの登録
    if (isset($request->image_id)) {
        $this->storeThumbnail($request->image_id, $post);
    } //サムネイル画像の登録があれば、登録
    $post->fill($request->validated())->save(); //その他検証済みのデータも合わせてセーブ
    return redirect(route('post.edit', $post));
    }

    public function delete(Request $request)
    {
        if ($request->checkedIds) {
            foreach ($request->checkedIds as $deleteId) {
                $this->deletePost($deleteId);
            }
        } else {
            $this->deletePost($request->deleteId);
        }
        return redirect(route('post.index'));
    }

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

    public function deletePost($deleteId): void
    {
        $post = Post::findOrFail($deleteId);
        $this->deleteThumbnail($post);
        $post->delete();
    }

    public function deleteThumbnail(Post $post): void
    {
        if (isset($post->post_thumbnail)) {
            \unlink(public_path() . '/thumbnail/' . $post->post_thumbnail);
        }
    }

    public function readImage()
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
