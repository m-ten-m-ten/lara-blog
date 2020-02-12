@extends('_includes._l-admin')

@if($tag->exists)
  @section('admin__title', 'タグ変更')
@else
  @section('admin__title', 'タグ追加')
@endif

@section('link-button')
  <a class="button" href="{{ route('admin.tag.index') }}"><span class="overTablet">タグ</span>一覧</a>
  @if($tag->exists)
    <a class="button" href="{{ route('admin.tag.create') }}">新規作成</a>
  @endif
@endsection

@section('admin__content')

<form class="form" method="POST">
  @csrf
  <ul>
    <li class="form__row">
      <label class="form__title">タグ名</label>
      <input type="text" class="{{$errors->has('tag_title') ? 'form__input-error' : 'form__input ' }}" name="tag_title" value="{{ old('tag_title', $tag->tag_title) }}" required maxlength="15">
      @error('tag_title')
        <p class="error-text">{{ $message }}</p>
      @enderror
    </li>

    <li class="form__row">
      <label class="form__title">スラッグ（使用可能：数字 / 英字(小文字) / - / _ ）</label>
      <input type="tag_name" class="{{$errors->has('tag_name') ? 'form__input-error' : 'form__input ' }}" name="tag_name" value="{{ old('tag_name', $tag->tag_name) }}" required maxlength="50" pattern="^[-_a-z0-9]{1,50}$">
      @error('tag_name')
        <p class="error-text">{{ $message }}</p>
      @enderror
    </li>
  </ul>

  <button type="submit" class="button">{{ $tag->exists ? '変更' : '登録'}}</button>
</form>

@endsection