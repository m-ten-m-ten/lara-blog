@extends('_includes._layout')
@section('content')

<div class="l-admin-create">

  {{-- 管理者画面ヘッダー --}}
  <div class="m-admin-header">
    <div class="m-admin-header-left">
      <h1 class="m-admin-header-title">画像{{ ($image->exists) ? '変更' : '追加'}}</h1>
      <a class="m-button" href="{{ route('admin.image.index') }}">画像一覧へ</a>
    </div>
  </div>

  {{-- 管理者画面メイン --}}
  @include('_includes._m-status')

  <div class="m-admin-form mt10">

    <form class="m-form" method="POST" enctype="multipart/form-data">
      @csrf
      <ul>
        <li class="m-form-row">
          @if ($image->exists)
            <img class="block" src="/img/{{ $image->image_name }}.{{ $image->image_extension }}">
          @else
            <label for="image_file" class="m-form-title mb10">画像ファイル（jpeg / png）</label>
            <input name="image_file" type="file" required>
            @error('image_file')
              <p class="error-text">{{ $message }}</p>
            @enderror
          @endif
       </li>

        <li class="m-form-row">
          <label class="m-form-title">ファイル名（使用可能：数字 / 英字(小文字) / - / _ ）</label>
          <input type="image_name" class="{{$errors->has('image_name') ? 'm-form-input--error' : 'm-form-input ' }}" name="image_name" value="{{ old('image_name', $image->image_name) }}" required maxlength="50" pattern="^[-_a-z0-9]{1,50}$">
          @error('image_name')
            <p class="error-text">{{ $message }}</p>
          @enderror
        </li>
      </ul>

      <button type="submit" class="m-button">{{ $image->exists ? '変更' : '登録'}}</button>
    </form>

  </div>
</div>
@endsection