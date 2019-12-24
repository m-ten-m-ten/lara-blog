<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\post;
use App\Image;
use App\Category;
use App\Http\Requests\StoreBlogPost;

class PostController extends Controller
{

  public function index(){
    $posts = Post::orderBy('created_at', 'desc')->paginate(10);
    return view('dashboard.post.index', compact('posts'));
  }

  public function create(){
    $data = [
      'images' => Image::orderBy('created_at', 'desc')->paginate(10),
      'categories' => Category::all(),
    ];
    return view('dashboard.post.create', $data);
  }

  public function store( StoreBlogPost $req ){
    $post = new Post();
    switch ($req->submit_btn) {
      case 'draft_btn':
        $post->post_drafted = Carbon::now();
        $post->post_status = 'drafted';
        break;
      case 'publish_btn':
        $post->post_published = Carbon::now();
        $post->post_status = 'published';
        break;
      default:
        # code...
        break;
    }
    $post->fill($req->except('_token'))->save();
    return redirect('dashboard/post/'.$post->id.'/edit');
  }

  public function edit( Post $post ){
    $data = [
      'post' => $post,
      'images' => Image::orderBy('created_at', 'desc')->paginate(10),
      'categories' => Category::all(),
    ];
    return view('dashboard.post.edit', $data);
  }

  public function update( StoreBlogPost $req, Post $post ){
    switch ($req->submit_btn) {
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
        # code...
        break;
      }
      $post->fill($req->except('_token', '_method'))->save();

      $data = [
        'post' => $post,
        'images' => Image::orderBy('created_at', 'desc')->paginate(10),
        'categories' => Category::all(),
      ];

    return view('dashboard/post/edit', $data);
  }

  public function delete(Request $req)
  {
    if($req->checked_posts) {
      Post::destroy($req->checked_id);
    } else {
      $post = Post::findOrFail($req->delete_id);
      $post->delete();
    }
    return redirect('dashboard/post');
  }

}
