@extends('_includes._layout')
@section('content')

<div class="l-user-index">


  {{-- ユーザー画面ヘッダー --}}
  <div class="m-user-header">
    <h1 class="m-user-header-title">MENU</h1>

    <div class="m-user-header-right">
      <button class="m-button"
      onclick="event.preventDefault();
      document.getElementById('logout-form').submit();"
      >ログアウト</button>
      <form id="logout-form" class="hidden" action="{{ route('user.logout') }}" method="POST">
        @csrf
      </form>
    </div>
  </div>

  @include('_includes._m-status')

  <div class="m-admin-menu">

    <div class="m-admin-menu-section">
      <ul>
        <li><a class="text-link" href="{{ route('user.profile.edit') }}">登録情報変更</a></li>
        <li><a class="text-link" href="{{ route('user.message.index') }}">メッセージ閲覧</a></li>
        <li><a class="text-link" href="{{ route('user.payment.top') }}">お支払い情報</a></li>
      </ul>
    </div>
  </div>

</div>
@endsection