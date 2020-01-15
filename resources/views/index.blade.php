@extends('_includes._layout')

@section('content')

<div class="sm:py-2">

  @if(isset($category) || isset($tag))
      <div class="mb-3 text-gray-700">
        <a class="text-blue-500" href="{{ route('home') }}">HOME</a> > {{ isset($category)? 'カテゴリー「' . $category->category_title: 'タグ「' . $tag->tag_title }}」の記事一覧
      </div>
  @endif

  @if(isset($category) || isset($tag))
    <div class="bg-gray-200 sm:px-4 px-2 sm:py-6 py-3">
      <div class="sm:pl-4 pl-3 relative sm:text-xl">
        <div class="bg-gray-900 absolute top-0 left-0 w-1 h-full rounded"></div>
        {{ isset($category)? $category->category_title: $tag->tag_title }}の記事一覧
      </div>
    </div>
  @endif
  <ul class="last-border-none">
    @foreach ( $posts as $post )
      <li class="border-b border-gray-300 sm:py-2">
        <a href="/{{ $post->id }}" class="block flex items-start py-2">
          @if (isset($post->post_thumbnail))
            <img class="md:mr-8 mr-2 sm:w-48 w-24" src="/thumbnail/{{ $post->post_thumbnail }}" alt="">
          @endif
          <div>
            <span class="text-gray-600 text-sm">{{ $post->post_published->format('Y.m.d') }}</span>
            <h2 class="sm:text-2xl leading-tight sm:mb-2">{{ $post->post_title }}</h2>
            <div class="text-gray-700 hidden sm:block">{{ $post->post_excerpt }}</div>
          </div>
        </a>
      </li>
    @endforeach
  </ul>
</div>

{{ $posts->links() }}

@endsection
