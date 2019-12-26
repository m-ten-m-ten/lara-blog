@extends('layouts.base')
@section('content')

<div class="post-title border border-gray-300 px-4 py-2">
  <h1 class="text-3xl font-semibold">{{ $post->post_title}}</h1>
  <div class="flex justify-end">
    <span>{{ $post->post_published->format('Y.m.d') }}</span>
  </div>
  <div class="flex">

    @if(isset($post->category))
      <a href="/category/{{ $post->category->id }}" class="text-sm text-gray-700 hover:text-white hover:bg-gray-500 border border-gray-500 rounded-full mr-2 p-1">{{ $post->category->category_title }}</a>
    @endif

    @foreach ($post->tags as $tag)
      <a href="/tag/{{ $tag->id }}" class="text-sm text-gray-700 hover:text-white hover:bg-gray-500 border border-gray-500 rounded-full mr-2 p-1">{{ $tag->tag_title }}</a>
    @endforeach
  </div>
</div>

<div class="post-content py-2">
  {!! $post->post_content !!}
</div>
@endsection