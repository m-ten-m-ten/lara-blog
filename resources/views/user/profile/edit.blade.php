@extends('_includes._l-form--center')
@section('title', '登録情報変更')
@section('form-content')

@include('_includes._m-status')

@include('_includes._m-error')

<form method="post">
  @csrf
  <ul>
    <li class="m-form-row">
      <label class="m-form-title">名前</label>
      <input class="{{$errors->has('name') ? 'm-form-input--error' : 'm-form-input ' }}" type="text" name="name" value="{{ old('name', $user->name)}}" required>
    </li>

    <li class="m-form-row">
      <label class="m-form-title">メールアドレス</label>
      <input class="{{$errors->has('email') ? 'm-form-input--error' : 'm-form-input ' }}" type="email" name="email" value="{{ old('email', $user->email) }}" required emali>
    </li>
  </ul>

  <button type="submit" class="m-button mr5">更新</button>
  <a class="text-link" href="{{ route('user.top') }}">{{ auth()->user()->name }}さんページへ戻る</a>

</form>
@endsection