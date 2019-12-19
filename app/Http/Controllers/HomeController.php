<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class HomeController extends Controller
{

    public function show(){
      $data = [
        'posts' => Post::paginate(10)
      ];
        return view('index', $data);
    }
}
