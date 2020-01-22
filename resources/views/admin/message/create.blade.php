@extends('_includes._layout')

@section('content')
<div class="container">
  <h1>メッセージ{{ ($message->exists) ? '変更': '登録' }}</h1>


  @include('_includes._m-error')
  @include('_includes._m-status')

  <form method="post">
    @csrf

    <ul>
      <li>
        <label>誰宛</label>
        <select name="user_id">
          <option value="">選択して下さい</option>
          @foreach($userlist as $key => $val)
          <option value="{{ $key }}" @if (old('user_id', $message->user_id) == $key) selected @endif>{{ $val }}</option>
          @endforeach
        </select>
      </li>

      <li>
        <label>タイトル</label>
        <input type="text" name="title" size="50" value="{{ old('title', $message->title) }}" class="text-form" required>
      </li>

      <li>
        <label>本文</label>
        <textarea name="content" cols="60" rows="10" class="text-form" required>{{ old('content', $message->content) }}</textarea>
      </li>
    </ul>

    <input type="submit" value="{{ ($message->exists) ? '変更する': '登録する' }}" class="btn-blue my-3">
  </form>
</div>
@stop