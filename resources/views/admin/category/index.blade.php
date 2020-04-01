@extends('_includes._l-admin')
@section('jsAction', 'adminIndex')
@section('admin__title', 'カテゴリー一覧')

@section('link-button')
  <a class="button" href="/admin/category/create">新規追加</a>
@endsection

@section('admin__content')

<div class="admin__index">

  <form class="confirm checkAll-wrapper" method="POST" action="/admin/category/delete">
    @csrf
    @method('DELETE')

    <button class="button__inverse admin__index-batchSubmit batchSubmit" type="submit" name="checked" value="checked">一括削除</button>

    <table class="admin__index-table">
      <tr>
        <th><input class="checkAll-trigger" type="checkbox"></th>
        <th>カテゴリー</th>
        <th>スラッグ</th>
        <th></th>
      </tr>
      <tbody>
        @foreach ($categories as $category)
        <tr>
          <td><input type="checkbox" name="checkedIds[]" value="{{ $category->id }}"></td>
          <td><a class="text-link" href="{{ route('admin.category.edit', $category->category_name)}}">{{ $category->category_title }}</a></td>
          <td>{{ $category->category_name }}</td>
          <td class="nowrap">
            <a class="text-link" href="{{ route('admin.category.edit', $category->category_name)}}">編集</a>
            <span class="overTablet">|</span>
            <br class="forTablet">
            <button class="text-link" type="submit" name="deleteId" value="{{ $category->id }}">削除</button>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </form>

  <div class="admin__index-pagination">
    {{ $categories->links() }}
  </div>

</div>

@endsection