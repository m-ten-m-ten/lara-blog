@extends('_includes._l-form--center')
@section('title', '確認画面')
@section('form-content')
<form method="POST">
  @csrf

  <ul>
    <li class="m-form-row">
      <label class="m-form-title">{{__('message.name')}}</label>
      <div class="m-form-confirm">{{ $user->name }}</div>
    </li>
    <li class="m-form-row">
      <label class="m-form-title">{{__('message.email')}}</label>
      <div class="m-form-confirm">{{ $user->email }}</div>
    </li>
    <li class="m-form-row">
      <label class="m-form-title">{{__('message.password')}}</label>
      <div class="m-form-confirm">(表示されません)</div>
    </li>
  </ul>

  <input type="submit" class="m-button mr5" value="送信する">
  <a class="text-link" href="{{ route('signup.index') }}">入力画面へ戻る</a>

</form>
@endsection