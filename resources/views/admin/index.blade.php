@extends('_includes._l-admin')

@section('jsAction', 'adminIndex')
@section('admin__title', '管理者メニュー')

@section('link-button')
  <button class="button"
  onclick="event.preventDefault();
  document.getElementById('logout-admin').submit();"
  >ログアウト</button>
  <form id="logout-admin" class="hidden" action="{{ route('admin.logout') }}" method="POST">
    @csrf
  </form>
@endsection

@section('admin__content')

<div class="admin__index-menu">

  <div class="admin__index-menu-section">
    <h2>記事・固定ページ</h2>
    <ul>
      <li><a class="text-link" href="{{ route('admin.post.index') }}">投稿一覧</a></li>
      <li><a class="text-link" href="{{ route('admin.post.create') }}">投稿新規作成</a></li>
      <li><a class="text-link" href="{{ route('admin.page.index') }}">固定ページ一覧</a></li>
      <li><a class="text-link" href="{{ route('admin.page.create') }}">固定ページ新規作成</a></li>
      <li><a class="text-link" href="{{ route('admin.image.index') }}">画像一覧</a></li>
      <li><a class="text-link" href="{{ route('admin.image.create') }}">画像追加</a></li>
      <li><a class="text-link" href="{{ route('admin.category.index') }}">カテゴリー一覧</a></li>
      <li><a class="text-link" href="{{ route('admin.category.create') }}">カテゴリー新規作成</a></li>
      <li><a class="text-link" href="{{ route('admin.tag.index') }}">タグ一覧</a></li>
      <li><a class="text-link" href="{{ route('admin.tag.create') }}">タグ新規作成</a></li>
    </ul>
  </div>

  <div class="admin__index-menu-section">

    <h2>ユーザー</h2>
    <ul>
      <li><a class="text-link" href="{{ route('admin.user.index') }}">ユーザー一覧</a></li>
    </ul>

    <h2>メッセージ</h2>
    <ul>
      <li><a class="text-link" href="{{ route('admin.message.index') }}">メッセージ一覧</a></li>
      <li><a class="text-link" href="{{ route('admin.message.create') }}">メッセージ新規作成</a></li>
    </ul>

  </div>
</div>

@endsection