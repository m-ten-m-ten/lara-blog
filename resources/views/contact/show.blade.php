@extends('_includes._l-form')
@section('title', 'お問い合わせ')
@section('form-content')

<form method="POST">
  @csrf
  <ul>
    <li class="form__row">
      <label class="form__title">名前</label>
      <input type="text" class="{{$errors->has('name') ? 'form__input-error' : 'form__input' }}" name="name" value="{{ old('name', $contact['name'])?: '' }}" required autocomplete="name" maxlength="50">
      @error('name')<span class="error-text">{{ $message }}</span>@enderror
    </li>
    <li class="form__row">
      <label class="form__title">メールアドレス</label>
      <span class="form__note">※返信が必要な方はご入力ください。</span>
      <input type="email" class="{{$errors->has('email') ? 'form__input-error' : 'form__input' }}" name="email" value="{{ old('email', $contact['email'])?: '' }}" autocomplete="email">
      @error('email')<span class="error-text">{{ $message }}</span>@enderror
    </li>
    <li class="form__row">
      <label class="form__title">お問い合わせ内容</label>
      <textarea class="{{$errors->has('body') ? 'form__input-error' : 'form__input' }}" name="body" type="text" rows="10" required maxlength="1000">{{ old('body', $contact['body'])?: '' }}</textarea>
      @error('body')<span class="error-text">{{ $message }}</span>@enderror
    </li>
  </ul>

  <input type="submit" class="button" value="確認画面へ">
</form>

@endsection