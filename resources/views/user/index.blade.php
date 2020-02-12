@extends('_includes._l-user')
@section('user-title', 'MENU')
@section('user-content')

<ul>
  <li><a class="text-link" href="{{ route('user.profile.edit') }}">登録情報変更</a></li>
  <li><a class="text-link" href="{{ route('user.message.index') }}">メッセージ閲覧</a></li>
  <li><a class="text-link" href="{{ route('user.payment.top') }}">お支払い情報</a></li>
</ul>

@endsection