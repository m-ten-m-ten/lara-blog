<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\post;
use App\Image;
use App\Category;
use App\Tag;

class HomeController extends Controller
{

  public function index(){
    $data = [
      'posts' => Post::where('post_status', 'published')->orderBy('post_published', 'desc')->paginate(10),
      'images' => Image::all(),
      'categories' => Category::all(),
      'tags' => Tag::all(),
    ];
    return view('index', $data);
  }

  public function show(Post $post){
    $data = [
      'post' => $post,
      'images' => Image::all(),
      'categories' => Category::all(),
      'tags' => Tag::all(),
    ];
    return view('show', $data);
  }

  public function category(Category $category) {
    $data = [
      'category' => $category,
      'posts' => Category::find($category->id)->posts()->orderBy('post_published', 'desc')->paginate(10),
      'images' => Image::all(),
      'categories' => Category::all(),
      'tags' => Tag::all(),
    ];
    return view('index', $data);
  }

  public function tag(Tag $tag) {
    $data = [
      'tag' => $tag,
      'posts' => Tag::find($tag->id)->posts()->orderBy('post_published', 'desc')->paginate(10),
      'images' => Image::all(),
      'categories' => Category::all(),
      'tags' => Tag::all(),
    ];
    return view('index', $data);
  }
}