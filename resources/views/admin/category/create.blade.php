@extends('_includes._l-admin')

@if($category->exists)
  @section('admin__title', 'カテゴリー変更')
@else
  @section('admin__title', 'カテゴリー追加')
@endif

@section('link-button')
  <a class="button" href="{{ route('admin.category.index') }}"><span class="overTablet">カテゴリー</span>一覧</a>
  @if($category->exists)
    <a class="button" href="{{ route('admin.category.create') }}">新規作成</a>
  @endif
@endsection

@section('admin__content')

<form class="form" method="POST">
  @csrf
  @include('_includes._categoryForm')
  <button type="submit" class="button">{{ $category->exists ? '変更' : '登録'}}</button>
</form>

@endsection