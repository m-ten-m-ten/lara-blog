<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\post;
use App\Http\Requests\StoreBlogPost;

class PostController extends Controller
{

  public function index(){
    $data = [
      'posts' => Post::orderBy('created_at', 'desc')->paginate(10)
    ];
    return view('dashboard.post.index', $data);
  }

  public function create(){
    return view('dashboard.post.create');
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

  public function edit( Post $post )
  {
   return view('dashboard/post/edit', compact('post'));
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
    return view('dashboard/post/edit', compact('post'));
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
