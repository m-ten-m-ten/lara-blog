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

  <a class="m-button--inverse" href="{{ route('signup.index') }}">戻る</a>
  <input type="submit" class="m-button" value="送信する">
</form>
@endsection