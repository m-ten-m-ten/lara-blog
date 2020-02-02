@extends('_includes._layout')

@section('content')

<section class="l-index">

  @if(isset($category) || isset($tag))
    <div class="m-breadcrumb">
      <ul>
        <li><a class="text-link" href="{{ route('home') }}">HOME</a></li>
        <li>{{ isset($category)? 'カテゴリー「' . $category->category_title: 'タグ「' . $tag->tag_title }}」の記事一覧</li>
      </ul>
    </div>

    <div class="m-index-title">
      <span>{{ isset($category)? $category->category_title: $tag->tag_title }}の記事一覧</span>
    </div>
  @endif

  <ul class="m-index-postList">
    @foreach ( $posts as $post )
      <li class="">
        <a href="/{{ $post->id }}" class="l-row">
          <div class="thumbnailImg">
            <img src="{{$post->thumbnail_path?: ''}}" alt="">
          </div>
          <div class="m-index-postList-info">
            @if($post->for_subscriber == 1)
              <span class="m-index-postList-subscriber">[有料会員用]</span>
            @endif
            <span class="m-index-postList-date">{{ $post->post_published->format('Y.m.d') }}</span>
            <h2 class="m-index-postList-title">{{ $post->post_title }}</h2>
            <div class="m-index-postList-exerpt">{{ Str::limit($post->post_excerpt, 200) }}</div>
          </div>
        </a>
      </li>
    @endforeach
  </ul>

{{ $posts->links() }}

</section>

@endsection
