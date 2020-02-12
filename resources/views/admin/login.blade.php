@extends('_includes._l-form')
@section('title', '管理者ログイン')
@section('form-content')

<form class="form" method="POST">
  @csrf
  <ul>
    <li class="form__row">
      <label class="form__title">ログインID</label>
      <input type="text" class="{{$errors->has('username') ? 'form__input-error' : 'form__input ' }}" name="username" value="{{ old('username') }}" required>
      @error('username')
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
</form>
@endsection