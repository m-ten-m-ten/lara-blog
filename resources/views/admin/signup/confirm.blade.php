@extends('_includes._l-form')
@section('title', '管理者登録確認画面')
@section('form-content')
<form method="POST">
  @csrf

  <ul>
    <li class="form__row">
      <label class="form__title">{{__('message.email')}}</label>
      <div class="form__confirm">{{ $admin->email }}</div>
    </li>
    <li class="form__row">
      <label class="form__title">{{__('message.password')}}</label>
      <div class="form__confirm">(表示されません)</div>
    </li>
  </ul>

  <input type="submit" class="button mr5" value="送信する">
  <a class="text-link" href="{{ route('signup.show') }}">入力画面へ戻る</a>

</form>
@endsection