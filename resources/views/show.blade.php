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

    @if($post->for_subscriber == 1)
      <span class="m-show-title-subscriber">[有料会員用]</span>
    @endif
    <span class="m-show-title-date">{{ $post->post_published->format('Y.m.d') }}</span>

    @if ($post->category)
      <a class="m-show-title-attr" href="/category/{{ $post->category->id }}">{{ $post->category->category_title }}</a>
    @endif

    @foreach ($post->tags as $tag)
      <a class="m-show-title-attr" href="/tag/{{ $tag->id }}">{{ $tag->tag_title }}</a>
    @endforeach

  </div>


  <div class="m-show-content">

    {{-- 有料会員用の記事は管理者及び有料会員のみ本文を表示。
      無料会員には支払い情報ページリンク、非会員には会員登録ページリンクを表示。 --}}
    @if($post->for_subscriber == 1)

      @if(auth('admin')->check() || auth('user')->check())

        {{-- 管理者及び有料会員には本文表示 --}}
        @if(auth('admin')->check() || auth('user')->user()->status == 1)
          {!! $post->post_content !!}

        {{-- 無料会員には支払い情報ページリンクを表示 --}}
        @else
          <p>この記事は有料会員様向けです。<a class="text-link" href="{{ route('user.payment.top')}}">こちら</a>からご登録下さい。</p>
        @endif

      {{-- 非会員には会員登録ページへのリンクを表示 --}}
      @else
        <p>この記事は有料会員様向けです。<a class="text-link" href="{{ route('signup.index')}}">こちら</a>からご登録下さい。</p>
      @endif

    @else
      {!! $post->post_content !!}
    @endif

  </div>

</div>

@endsection