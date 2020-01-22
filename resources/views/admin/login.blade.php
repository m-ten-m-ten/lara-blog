@extends('_includes._l-form--center')
@section('title', '管理者ログイン')
@section('form-content')

<form class="m-form" method="POST">
  @csrf
  <ul>
    <li class="m-form-row">
      <label class="m-form-title">ログインID</label>
      <input type="text" class="{{$errors->has('username') ? 'm-form-input--error' : 'm-form-input ' }}" name="username" value="{{ old('username') }}" required>
      @error('username')
        <p class="error-text">{{ $message }}</p>
      @enderror
    </li>

    <li class="m-form-row mb-2">
      <label class="m-form-title">パスワード</label>
      <input type="password" class="{{$errors->has('password') ? 'm-form-input--error' : 'm-form-input ' }}" name="password" required minlength="8" maxlength="30">
      @error('password')
        <p class="error-text">{{ $message }}</p>
      @enderror
    </li>
  </ul>

  <input type="submit" value="ログイン" class="m-button">
</form>
@endsection