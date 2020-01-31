@extends('_includes._layout')
@section('content')

<div class="l-admin-create">

  {{-- 管理者画面ヘッダー --}}
  <div class="m-admin-header">
    <div class="m-admin-header-left">
      <h1 class="m-admin-header-title">メッセージ{{ ($message->exists)? '編集': '新規作成'}}</h1>
      <a class="m-button" href="{{ route('admin.message.index') }}">メッセージ一覧</a>
    </div>
  </div>

  {{-- 管理者画面メイン --}}
  @include('_includes._m-status')

  <div class="m-admin-form mt10">

    <form class="m-form" method="POST">
      @csrf

        <div class="m-form-row">
          <label class="m-form-title">あて先</label>
          <select name="user_id">
            <option value="">選択して下さい</option>
            @foreach($userlist as $key => $val)
              <option value="{{ $key }}" @if (old('user_id', $message->user_id) == $key) selected @endif>{{ $val }}</option>
            @endforeach
          </select>
        </div>

        <div class="m-form-row">
          <label class="m-form-title">タイトル</label>
          <input class="{{$errors->has('title') ? 'm-form-input--error' : 'm-form-input ' }}" type="text" name="title" size="50" value="{{ old('title', $message->title) }}" required maxlength="100">
        </div>

        <div class="m-form-row">
          <label class="m-form-title">本文</label>
          <textarea class="{{$errors->has('content') ? 'm-form-input--error' : 'm-form-input ' }}" name="content" cols="60" rows="10" required>{{ old('content', $message->content) }}</textarea>
        </div>

      <button type="submit" class="m-button">{{ ($message->exists) ? '変更': '登録' }}</button>

      </form>
    </div>
  </div>
@stop