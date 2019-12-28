<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\{post, Image, Category, Tag};
use App\Http\Requests\PostStoreRequest;

class PostController extends Controller
{

  public function index(){
    $posts = Post::latest()->paginate(10);
    return view('dashboard.post.index', compact('posts'));
  }

  public function create(){
    $data = [
      'images' => Image::latest()->paginate(15),
      'categories' => Category::all(),
      'tags' => Tag::all(),
    ];
    return view('dashboard.post.create', $data);
  }

  public function store( PostStoreRequest $request ){
    $post = new Post();
    $this->storeDateStatus($request, $post);
    $post->fill($request->except('_token'))->save();
    $this->storeTags($request, $post);
    $this->storeThumbnail($request, $post);
    return redirect('dashboard/post/'.$post->id.'/edit');
  }

  public function edit( Post $post ){
    $data = [
      'post' => $post,
      'images' => Image::latest()->paginate(15),
      'categories' => Category::all(),
      'tags' => Tag::all(),
    ];
    return view('dashboard.post.edit', $data);
  }

  public function update( PostStoreRequest $request, Post $post )
  {
    $this->storeDateStatus($request, $post);
    $post->fill($request->except('_token', '_method'))->save();
    $this->storeTags($request, $post);
    $this->storeThumbnail($request, $post);
    return redirect('dashboard/post/'.$post->id.'/edit');
  }

  public function delete(Request $request)
  {
    if($request->checkedIds) {
      foreach ($request->checkedIds as $deleteId) {
        $this->deletePost($deleteId);
      }
    } else {
      $this->deletePost($request->deleteId);
    }
    return redirect('dashboard/post');
  }

  public function storeDateStatus(PostStoreRequest $request, Post $post)
  {
    switch ($request->submit_btn) {
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

  public function storeTags(PostStoreRequest $request, Post $post)
  {
    if (is_array($request->tags)) {
      $post->tags()->detach();
      $post->tags()->attach($request->tags);
    }
  }

  public function storeThumbnail(PostStoreRequest $request, Post $post)
  {
    if (isset($request->image_id)) {
      $this->deleteThumbnail($post);
      $image = Image::find($request->image_id);
      $now = Carbon::now('Asia/Tokyo')->format('YmdHis');
      $file_name = $now . "thumbnail_" . $post->id . "." . $image->image_extension;
      $source = public_path() . "/img/" . $image->image_name . "." . $image->image_extension;
      $dest = public_path() . "/thumbnail/" . $file_name;
      copy($source, $dest);
      $post->post_thumbnail = $file_name;
      $post->save();
      }
  }

  public function deletePost($deleteId)
  {
    $post = Post::findOrFail($deleteId);
    $this->deleteThumbnail($post);
    $post->delete();
  }

  public function deleteThumbnail(Post $post)
  {
    if (isset ($post->post_thumbnail)) {
      unlink(public_path() . "/thumbnail/" . $post->post_thumbnail);
    }
  }

}
