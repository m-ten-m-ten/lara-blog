@extends('_includes._layout')
@section('content')

<div class="l-show">

  <div class="m-breadcrumb">
    <ul>
      <li><a class="text-link" href="{{ route('home') }}">HOME</a></li>
      @if($post->category)
        <li><a class="text-link" href="/category/{{ $post->category->id }}">カテゴリー「{{ $post->category->category_title }}」</a></li>
      @endif
      <li>記事ページ</li>
    </ul>
  </div>


  <div class="m-show-title">

    <h1 class="m-show-title-text">{{ $post->post_title }}</h1>

    <span class="m-show-title-date">{{ $post->post_published->format('Y.m.d') }}</span>

    @if ($post->category)
      <a class="m-show-title-attr" href="/category/{{ $post->category->id }}">{{ $post->category->category_title }}</a>
    @endif

    @foreach ($post->tags as $tag)
      <a class="m-show-title-attr" href="/tag/{{ $tag->id }}">{{ $tag->tag_title }}</a>
    @endforeach

  </div>


  <div class="m-show-content">
    {!! $post->post_content !!}
  </div>

</div>

@endsection