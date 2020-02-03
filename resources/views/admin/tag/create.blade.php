@extends('_includes._layout')
@section('content')

<div class="l-admin-create">

  {{-- 管理者画面ヘッダー --}}
  <div class="m-admin-header">
    <div class="m-admin-header-left">
      <h1 class="m-admin-header-title">タグ{{ ($tag->exists) ? '変更' : '追加'}}</h1>
    </div>
    <div class="m-admin-header-right">
      <a class="m-button" href="{{ route('admin.tag.index') }}"><span class="overTablet">タグ</span>一覧</a>
      @if($tag->exists)
        <a class="m-button" href="{{ route('admin.tag.create') }}">新規作成</a>
      @endif
    </div>
  </div>

  {{-- 管理者画面メイン --}}
  @include('_includes._m-status')

  <div class="m-admin-form mt10">
    <form class="m-form" method="POST">
      @csrf
      <ul>
        <li class="m-form-row">
          <label class="m-form-title">タグ名</label>
          <input type="text" class="{{$errors->has('tag_title') ? 'm-form-input--error' : 'm-form-input ' }}" name="tag_title" value="{{ old('tag_title', $tag->tag_title) }}" required maxlength="15">
          @error('tag_title')
            <p class="error-text">{{ $message }}</p>
          @enderror
        </li>

        <li class="m-form-row">
          <label class="m-form-title">スラッグ（使用可能：数字 / 英字(小文字) / - / _ ）</label>
          <input type="tag_name" class="{{$errors->has('tag_name') ? 'm-form-input--error' : 'm-form-input ' }}" name="tag_name" value="{{ old('tag_name', $tag->tag_name) }}" required maxlength="50" pattern="^[-_a-z0-9]{1,50}$">
          @error('tag_name')
            <p class="error-text">{{ $message }}</p>
          @enderror
        </li>
      </ul>

      <button type="submit" class="m-button">{{ $tag->exists ? '変更' : '登録'}}</button>
    </form>

  </div>
</div>
@endsection