@extends('_includes._layout')
@section('content')

<div class="l-admin-create">

  {{-- 管理者画面ヘッダー --}}
  <div class="m-admin-header">
    <div class="m-admin-header-left">
      <h1 class="m-admin-header-title">カテゴリー{{ ($category->exists) ? '変更' : '追加'}}</h1>
      <a class="m-button" href="{{ route('admin.category.index') }}">カテゴリー一覧へ</a>
    </div>
  </div>

  {{-- 管理者画面メイン --}}
  <div class="m-admin-form mt10">

    @include('_includes._m-status')

    <form class="m-form" method="POST">
      @csrf
      <ul>
        <li class="m-form-row">
          <label class="m-form-title">カテゴリー名</label>
          <input type="text" class="{{$errors->has('category_title') ? 'm-form-input--error' : 'm-form-input ' }}" name="category_title" value="{{ old('category_title', $category->category_title) }}" required maxlength="15">
          @error('category_title')
            <p class="error-text">{{ $message }}</p>
          @enderror
        </li>

        <li class="m-form-row">
          <label class="m-form-title">スラッグ（使用可能：数字 / 英字(小文字) / - / _ ）</label>
          <input type="category_name" class="{{$errors->has('category_name') ? 'm-form-input--error' : 'm-form-input ' }}" name="category_name" value="{{ old('category_name', $category->category_name) }}" required maxlength="50" pattern="^[-_a-z0-9]{1,50}$">
          @error('category_name')
            <p class="error-text">{{ $message }}</p>
          @enderror
        </li>
      </ul>

      <button type="submit" class="m-button">{{ $category->exists ? '変更' : '登録'}}</button>
    </form>

  </div>
</div>
@endsection