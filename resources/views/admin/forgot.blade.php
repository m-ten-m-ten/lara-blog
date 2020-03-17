@extends('_includes._l-form')
@section('title', '管理者用パスワードリセット申し込み')
@section('form-content')

<form class="form" method="POST">
  @csrf
  <ul>
    <li class="form__row">
      <label class="form__title">メールアドレス</label>
      <input type="text" class="{{$errors->has('email') ? 'form__input-error' : 'form__input ' }}" name="email" value="{{ old('email') }}" required>
      @error('email')
        <p class="error-text">{{ $message }}</p>
      @enderror
    </li>
  </ul>

  <input type="submit" value="パスワードリセット用リンクを送信" class="button">
  <div class="mt1"><a class="text-link" href="{{ route('user.login') }}">ログインページ</a></div>
</form>
@endsection