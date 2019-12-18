<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\post;
use App\Http\Requests\StoreBlogPost;

class PostController extends Controller
{

  public function index()
  {
    $data = [
      'posts' => Post::paginate(10)
    ];
    return view('dashboard.post.index', $data);
  }

  public function create()
  {
    return view('dashboard.post.create');
  }

  public function store( StoreBlogPost $req ){
    $p = new Post();
    switch ($req->submit_btn) {
      case 'draft_btn':
        $p->post_drafted = Carbon::now();
        $p->post_status = 'drafted';
        break;
      case 'publish_btn':
        $p->post_published = Carbon::now();
        $p->post_status = 'published';
        break;
      default:
        # code...
        break;
    }
    $p->fill($req->except('_token'))->save();
    return redirect('dashboard/post/'.$p->id.'/edit');
  }

  public function edit($id)
  {
   return view('dashboard/post/edit', [
      'p' => Post::findOrFail($id)
    ]);
  }

  public function update( StoreBlogPost $req, $id ){
    $p = Post::find($id);
    switch ($req->submit_btn) {
      case 'draft_btn':
        $p->post_drafted = Carbon::now();
        $p->post_status = 'drafted';
        break;
      case 'publish_btn':
        $p->post_published = Carbon::now();
        $p->post_status = 'published';
        break;
      case 'modify_btn':
        $p->post_modified = Carbon::now();
        $p->post_status = 'published';
        break;
      default:
        # code...
        break;
      }
    $p->fill($req->except('_token', '_method'))->save();
    return redirect('dashboard/post/'.$id.'/edit');
  }

  public function delete(Request $req)
  {
    if($req->checked_posts) {
      Post::destroy($req->checked_id);
    } else {
      $p = Post::findOrFail($req->delete_id);
      $p->delete();
    }
    return redirect('dashboard/post');
  }

}
