@extends('_includes._l-form--center')
@section('title', '登録画面')
@section('form-content')

<form method="POST">
  @csrf
  <ul>
    <li class="m-form-row">
      <label class="m-form-title">名前</label>
      <input type="text" class="{{$errors->has('name') ? 'm-form-input--error' : 'm-form-input' }}" name="name" value="{{ $user->name }}" required autocomplete="name">
      @error('name')<span class="error-text">{{ $message }}</span>@enderror
    </li>
    <li class="m-form-row">
      <label class="m-form-title">e-mail</label>
      <input type="email" class="{{$errors->has('email') ? 'm-form-input--error' : 'm-form-input' }}" name="email" value="{{ $user->email }}" required autocomplete="email">
      @error('email')<span class="error-text">{{ $message }}</span>@enderror
    </li>
    <li class="m-form-row">
      <label class="m-form-title">パスワード</label>
      <input type="password" class="{{$errors->has('password') ? 'm-form-input--error' : 'm-form-input' }}" name="password" required minlength="8" maxlength="30">
      @error('password')<span class="error-text">{{ $message }}</span>@enderror
    </li>
    <li class="m-form-row">
      <label class="m-form-title">パスワード（確認用）</label>
      <input type="password" class="m-form-input" name="password_confirmation" required minlength="8" maxlength="30">
    </li>
  </ul>

  <input type="submit" class="m-button" value="確認画面へ">
</form>

@endsection