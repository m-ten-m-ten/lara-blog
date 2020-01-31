@extends('_includes._layout')
@section('content')

<div class="l-user-index">

  @include('_includes._m-user-header', ['title' => 'MENU'])

  @include('_includes._m-status')

  <div class="m-user-main">

    <div class="m-user-menu-section">
      <ul>
        <li><a class="text-link" href="{{ route('user.profile.edit') }}">登録情報変更</a></li>
        <li><a class="text-link" href="{{ route('user.message.index') }}">メッセージ閲覧</a></li>
        <li><a class="text-link" href="{{ route('user.payment.top') }}">お支払い情報</a></li>
      </ul>
    </div>
  </div>

</div>
@endsection