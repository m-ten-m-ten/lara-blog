@extends('_includes._layout')
@section('content')

<div class="l-admin-index">

  {{-- 管理者画面ヘッダー --}}
  <div class="m-admin-header">
    <div class="m-admin-header-left">
      <h1 class="m-admin-header-title">カテゴリー一覧</h1>
      <a class="m-button" href="/admin/category/create">新規追加</a>
    </div>
  </div>

  {{-- 管理者画面メイン --}}

  @include('_includes._m-status')

  <form id="delete-form" method="POST" action="/admin/category/delete">
  @csrf
  @method('DELETE')

    <button id="multipleSubmitBtn" class="m-button--inverse m-admin-multiple-button" type="submit" name="checked" value="checked">一括削除</button>

    <table class="m-admin-table">
      <tr>
        <th><input type="checkbox" id="all"></th>
        <th>カテゴリー</th>
        <th>スラッグ</th>
        <th></th>
      </tr>
      <tbody id="boxes">
        @foreach ($categories as $category)
        <tr>
          <td><input type="checkbox" name="checkedIds[]" value="{{ $category->id }}"></td>
          <td><a href="/admin/category/edit/{{ $category->id }}">{{ $category->category_title }}</a></td>
          <td>{{ $category->category_name }}</td>
          <td class="nowrap">
            <a class="text-link" href="/admin/category/edit/{{ $category->id }}">編集</a>
            <span class="overTablet">|</span>
            <br class="forTablet">
            <button class="text-link" type="submit" name="deleteId" value="{{ $category->id }}">削除</button>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </form>

  <div class="m-admin-pagination">
    {{ $categories->links() }}
  </div>

</div>
@endsection