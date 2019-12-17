<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\post;


class PostController extends Controller
{

  public function __construct()
    {
        $this->middleware('auth');
    }
  
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

  public function store(Request $req)
  {
    $this->validate($req, Post::$rules);
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
    $p = Post::orderBy('id', 'desc')->first();
    return redirect('dashboard/post/'.$p->id.'/edit');
  }

  public function edit($id)
  {
   return view('dashboard/post/edit', [
      'p' => Post::findOrFail($id)
    ]);
  }

  public function update(Request $req, $id)
  {
    $this->validate($req, Post::$rules);
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
    return redirect('dashboard/post/index');
  }

}
