@extends('layouts.base')
@section('content')

<div class="post-title border border-gray-300 px-4 py-2">
  <h1 class="text-3xl font-semibold">{{ $post->post_title}}</h1>
  <div class="flex justify-end">
    <span>{{ $post->post_published->format('Y.m.d') }}</span>
  </div>
  <div class="flex">
    <a href="#" class="text-sm text-gray-700 border border-gray-500 rounded-lg mr-2 py-1 px-2">カテゴリー</a>
    <a href="#" class="text-sm text-gray-700 border border-gray-500 rounded-lg mr-2 py-1 px-2">タグ1</a>
    <a href="#" class="text-sm text-gray-700 border border-gray-500 rounded-lg mr-2 py-1 px-2">タグ2</a>
    <a href="#" class="text-sm text-gray-700 border border-gray-500 rounded-lg mr-2 py-1 px-2">タグ3</a>
  </div>
</div>

<div class="post-content py-2">
  {{ $post->post_content }}
</div>
@endsection