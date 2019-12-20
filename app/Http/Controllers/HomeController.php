<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\post;

class HomeController extends Controller
{

  public function index(){
    $data = [
      'posts' => Post::where('post_status', 'published')->orderBy('post_published', 'desc')->paginate(10)
    ];
    return view('index', $data);
  }

  public function show(Post $post){
    return view('show', compact('post'));
  }
}