@extends('_includes._layout')
@section('content')

<div class="l-user-index">

  <h1 class="m-user-index-title">{{ auth()->user()->name }}さんのメニュー</h1>

  <ul class="m-user-index-menu">
    <li><a class="text-link" href="{{ route('user.profile.edit') }}">登録情報変更</a></li>
    <li><a class="text-link" href="{{ route('user.message.index') }}">メッセージ閲覧</a></li>
  </ul>

  <button class="m-button" href="{{ route('admin.logout') }}"
    onclick="event.preventDefault();
    document.getElementById('logout-form').submit();
    ">ログアウト
  </button>
  <form id="logout-form" class="hidden" action="{{ route('user.logout') }}" method="POST">
    @csrf
  </form>

</div>
@endsection