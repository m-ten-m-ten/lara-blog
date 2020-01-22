@extends('_includes._layout')

@section('content')

<div class="l-admin-index">

  {{-- 管理者画面ヘッダー --}}
  <div class="m-admin-header">
    <h1 class="m-admin-header-title">管理者メニュー</h1>

    <div class="m-admin-header-right">
      <button class="m-button"
      onclick="event.preventDefault();
      document.getElementById('logout-form').submit();"
      >ログアウト</button>
      <form id="logout-form" class="hidden" action="{{ route('admin.logout') }}" method="POST">
        @csrf
      </form>
    </div>
  </div>

  {{-- 管理者画面メイン --}}
  <div class="m-admin-menu">

    <div class="m-admin-menu-section">
      <h2>ブログ</h2>
      <ul>
        <li><a class="text-link" href="{{ route('admin.post.index') }}">投稿一覧</a></li>
        <li><a class="text-link" href="{{ route('admin.post.create') }}">投稿新規作成</a></li>
        <li><a class="text-link" href="{{ route('admin.image.index') }}">画像一覧</a></li>
        <li><a class="text-link" href="{{ route('admin.image.create') }}">画像新規作成</a></li>
        <li><a class="text-link" href="{{ route('admin.category.index') }}">カテゴリー一覧</a></li>
        <li><a class="text-link" href="{{ route('admin.category.create') }}">カテゴリー新規作成</a></li>
        <li><a class="text-link" href="{{ route('admin.tag.index') }}">タグ一覧</a></li>
        <li><a class="text-link" href="{{ route('admin.tag.create') }}">タグ新規作成</a></li>
      </ul>
    </div>

    <div class="m-admin-menu-section">
      <h2>ユーザー</h2>
      <ul>
        <li><a class="text-link" href="{{ route('admin.user.index') }}">ユーザー一覧</a></li>
      </ul>
    </div>

    <div class="m-admin-menu-section">
      <h2>メッセージ</h2>
      <ul>
        <li><a class="text-link" href="{{ route('admin.message.index') }}">メッセージ一覧</a></li>
        <li><a class="text-link" href="{{ route('admin.message.create') }}">メッセージ新規作成</a></li>
      </ul>
    </div>
  </div>

</div>
@endsection