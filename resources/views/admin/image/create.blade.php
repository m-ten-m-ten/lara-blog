@extends('_includes._l-admin')
@section('content')

@section('admin__title', '画像追加')

@section('link-button')
  <a class="button" href="{{ route('admin.image.index') }}"><span class="overTablet">画像</span>一覧</a>
@endsection

@section('admin__content')

@include('_includes._error')

<form class="form" method="POST" enctype="multipart/form-data">
  @csrf

  <ul>
    <li class="form__row">
        <label class="form__title mb10">画像ファイル 複数可（jpeg / png）※ファイル名は「数字 / 英字(小文字) / - / _ 」50文字以内</label>
        <input name="image_files[]" type="file" required multiple>
  </ul>

  <button type="submit" class="button">登録</button>
</form>

@endsection