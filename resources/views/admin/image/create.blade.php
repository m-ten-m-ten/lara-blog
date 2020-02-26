@extends('_includes._l-admin')
@section('content')

@if($image->exists)
  @section('admin__title', '画像変更')
@else
  @section('admin__title', '画像追加')
@endif

@section('link-button')
  <a class="button" href="{{ route('admin.image.index') }}"><span class="overTablet">画像</span>一覧</a>
  @if($image->exists)
    <a class="button" href="{{ route('admin.image.create') }}">新規追加</a>
  @endif
@endsection

@section('admin__content')

<form class="form" method="POST" enctype="multipart/form-data">
  @csrf
  <ul>
    <li class="form__row">
      @if ($image->exists)
        <img class="block" src="{{ $image->path }}">
      @else
        <label for="image_file" class="form__title mb10">画像ファイル（jpeg / png）</label>
        <input name="image_file" type="file" required>
        @error('image_file')
          <p class="error-text">{{ $message }}</p>
        @enderror
      @endif
   </li>

    <li class="form__row">
      <label class="form__title">ファイル名（使用可能：数字 / 英字(小文字) / - / _ ）<br><span class="text-normal">※未入力時は選択したファイルのファイル名が登録されます。</span></label>
      <input type="image_name" class="{{$errors->has('image_name') ? 'form__input-error' : 'form__input ' }}" name="image_name" value="{{ old('image_name', $image->image_name) }}" maxlength="50" pattern="^[-_a-z0-9]{1,50}$">
      @error('image_name')
        <p class="error-text">{{ $message }}</p>
      @enderror
    </li>
  </ul>

  <button type="submit" class="button">{{ $image->exists ? '変更' : '登録'}}</button>
</form>

@endsection