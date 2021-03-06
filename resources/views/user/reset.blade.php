@extends('_includes._l-form')
@section('title', 'パスワードリセット')
@section('form-content')

<form method="POST" action="{{ route('user.update') }}">
  @csrf
  <input type="hidden" name="token" value="{{ $token }}">
  <ul>
    <li class="form__row">
      <label class="form__title">メールアドレス</label>
      <input type="email" class="{{$errors->has('email') ? 'form__input-error' : 'form__input' }}" name="email" value="{{ $email }}" required autocomplete="email">
      @error('email')<span class="error-text">{{ $message }}</span>@enderror
    </li>
    <li class="form__row">
      <label class="form__title">パスワード</label>
      <input type="password" class="{{$errors->has('password') ? 'form__input-error' : 'form__input' }}" name="password" required minlength="8" maxlength="30">
      @error('password')<span class="error-text">{{ $message }}</span>@enderror
    </li>
    <li class="form__row">
      <label class="form__title">パスワード（確認用）</label>
      <input type="password" class="form__input" name="password_confirmation" required minlength="8" maxlength="30">
    </li>
  </ul>

  <input type="submit" class="button" value="パスワードを変更する">
</form>

@endsection