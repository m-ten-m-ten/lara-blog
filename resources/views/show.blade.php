@extends('_includes._layout')
@section('jsAction', 'post')
@section('content')

<div class="l-show">

  <div class="l-show__main">

    @include('_includes._breadcrumb')

    <article class="article">

      <figure class="article__eye-catch">
        <img src="{{ $post->eye_catch }}" alt="">
      </figure>

      <div class="article__header">
        <span class="article__pub-date">
          公開日:{{ $post->post_published->format('Y.m.d') }}

          @if ($post->post_modified)
            更新日:{{ $post->post_modified->format('Y.m.d') }}
          @endif
        </span>

        @if ($post->for_subscriber === 1)
          <i class="article__subscriber fas fa-lock"></i>
        @endif
      </div>

      <h1 class="article__title">{{ $post->post_title }}</h1>

      @if ($post->category || !empty($post->tags))
        <div class="article__attr">
          @if ($post->category)
            <a href="/category/{{ $post->category->id }}">{{ $post->category->category_title }}</a>
          @endif

          @foreach ($post->tags as $tag)
            <a href="/tag/{{ $tag->tag_name }}">{{ $tag->tag_title }}</a>
          @endforeach
        </div>
      @endif

      <hr class="overPC">

      <div class="toc accordion-wrapper">
        <div class="toc__title accordion-trigger">Table of Contents</div>
        <div class="toc__body accordion-body"></div>
      </div>

      {{-- 有料会員用の記事は管理者及び有料会員のみ本文を表示。
        無料会員には支払い情報ページリンク、非会員には会員登録ページリンクを表示。 --}}
      @if($post->for_subscriber == 1)

        @if(auth('admin')->check() || auth('user')->check())

          {{-- 管理者及び有料会員には本文表示 --}}
          @if(auth('admin')->check() || auth('user')->user()->status == 1)
            @include('_includes._article__body')

          {{-- 無料会員には支払い情報ページリンクを表示 --}}
          @else
            <p>この記事は有料会員様向けです。<a class="text-link" href="{{ route('user.payment.index')}}">こちら</a>からご登録下さい。</p>
          @endif

        {{-- 非会員には会員登録ページへのリンクを表示 --}}
        @else
          <p>この記事は有料会員様向けです。<a class="text-link" href="{{ route('signup.show')}}">こちら</a>からご登録下さい。</p>
        @endif

      @else
        @include('_includes._article__body')
      @endif

    </article>

  </div>

  {{-- サイドバー --}}
  @include('_includes._sidebar')

</div>

@endsection