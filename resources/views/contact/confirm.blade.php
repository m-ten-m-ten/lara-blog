@extends('_includes._l-form')
@section('title', 'お問い合わせ確認画面')
@section('form-content')
<form method="POST">
  @csrf

  <ul>
    <li class="form__row">
      <label class="form__title">名前</label>
      <div class="form__confirm">{{ $contact['name'] }}</div>
    </li>
    <li class="form__row">
      <label class="form__title">メールアドレス</label>
      <div class="form__confirm">{{ $contact['email']?: '(未入力)' }}</div>
    </li>
    <li class="form__row">
      <label class="form__title">お問い合わせ内容</label>
      <div class="form__confirm">{{ $contact['body'] }}</div>
    </li>
  </ul>

  <input type="submit" class="button mr5" value="送信する">
  <a class="text-link" href="{{ route('contact.show') }}">入力画面へ戻る</a>

</form>
@endsection