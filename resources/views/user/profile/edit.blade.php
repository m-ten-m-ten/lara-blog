@extends('_includes._l-form')
@section('title', '登録情報変更')
@section('form-content')

@include('_includes._error')

<form method="post">
  @csrf
  <ul>
    <li class="form__row">
      <label class="form__title">名前</label>
      <input class="{{$errors->has('name') ? 'form__input-error' : 'form__input ' }}" type="text" name="name" value="{{ old('name', $user->name)}}" required>
    </li>

    <li class="form__row">
      <label class="form__title">メールアドレス</label>
      <input class="{{$errors->has('email') ? 'form__input-error' : 'form__input ' }}" type="email" name="email" value="{{ old('email', $user->email) }}" required emali>
    </li>
  </ul>

  <button type="submit" class="button mr5">更新</button>
  <a class="text-link" href="{{ route('user.index') }}">{{ auth()->user()->name }}さんページへ戻る</a>

</form>
@endsection