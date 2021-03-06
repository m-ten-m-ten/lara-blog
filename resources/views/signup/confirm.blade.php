@extends('_includes._l-form')
@section('title', '確認画面')
@section('form-content')
<form method="POST">
  @csrf

  <ul>
    <li class="form__row">
      <label class="form__title">名前</label>
      <div class="form__confirm">{{ $user->name }}</div>
    </li>
    <li class="form__row">
      <label class="form__title">メールアドレス</label>
      <div class="form__confirm">{{ $user->email }}</div>
    </li>
    <li class="form__row">
      <label class="form__title">パスワード</label>
      <div class="form__confirm">(表示されません)</div>
    </li>
  </ul>

  <input type="submit" class="button mr5" value="送信する">
  <a class="text-link" href="{{ route('signup.show') }}">入力画面へ戻る</a>

</form>
@endsection