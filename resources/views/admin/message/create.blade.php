@extends('_includes._l-admin')


@if($message->exists)
  @section('admin__title', 'メッセージ変更')
@else
  @section('admin__title', '新規作成')
@endif

@section('link-button')
  <a class="button" href="{{ route('admin.message.index') }}">メッセージ一覧</a>
@endsection

@section('admin__content')

<form class="form" method="POST">
  @csrf

  <div class="form__row">
    <label class="form__title">あて先</label>
    <select name="user_id">
      <option value="">選択して下さい</option>
      @foreach($userlist as $key => $val)
        <option value="{{ $key }}" @if (old('user_id', $message->user_id) == $key) selected @endif>{{ $val }}</option>
      @endforeach
    </select>
  </div>

  <div class="form__row">
    <label class="form__title">タイトル</label>
    <input class="{{$errors->has('title') ? 'form__input-error' : 'form__input ' }}" type="text" name="title" size="50" value="{{ old('title', $message->title) }}" required maxlength="100">
  </div>

  <div class="form__row">
    <label class="form__title">本文</label>
    <textarea class="{{$errors->has('content') ? 'form__input-error' : 'form__input ' }}" name="content" cols="60" rows="10" required>{{ old('content', $message->content) }}</textarea>
  </div>

  <button type="submit" class="button">{{ ($message->exists) ? '変更': '登録' }}</button>

</form>

@endsection