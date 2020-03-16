@extends('_includes._l-form')
@section('title', 'ユーザーログイン')
@section('form-content')

<form class="form" method="POST">
  @csrf
  <ul>
    <li class="form__row">
      <label class="form__title">メールアドレス</label>
      <input type="text" class="{{$errors->has('email') ? 'form__input-error' : 'form__input ' }}" name="email" value="{{ old('email') }}" required autocomplete="email">
      @error('email')
        <p class="error-text">{{ $message }}</p>
      @enderror
    </li>

    <li class="form__row mb-2">
      <label class="form__title">パスワード</label>
      <input type="password" class="{{$errors->has('password') ? 'form__input-error' : 'form__input ' }}" name="password" required minlength="8" maxlength="30">
      @error('password')
        <p class="error-text">{{ $message }}</p>
      @enderror
    </li>
  </ul>

  <input type="submit" value="ログイン" class="button">
  <a class="text-link block mt1" href="{{ route('user.forgot') }}">パスワードをお忘れですか？</a>
</form>
@endsection