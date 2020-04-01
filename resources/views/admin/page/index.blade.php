{{-- 固定ページ一覧画面 --}}

@extends('_includes._l-admin')

@section('jsAction', 'adminIndex')
@section('admin__title', '固定ページ一覧')

@section('link-button')
  <a class="button" href={{ route('admin.page.create') }}>新規追加</a>
@endsection

@section('admin__content')

<form class="confirm checkAll-wrapper" method="POST" action="/admin/page/delete">
  @csrf
  @method('DELETE')

  <button class="button__inverse admin__index-batchSubmit batchSubmit" type="submit" name="checked" value="checked">一括削除</button>

  <table class="admin__index-table">
    <tr>
      <th><input class="checkAll-trigger" type="checkbox"></th>
      <th>タイトル</th>
      <th>スラッグ</th>
      <th></th>
    </tr>
    <tbody>
      @foreach ($pages as $page)
      <tr>
        <td><input type="checkbox" name="checkedIds[]" value="{{ $page->id }}"></td>
        <td>
          <a class="text-link" href="/admin/page/edit/{{ $page->page_name }}">{{ Str::limit($page->page_title, 50) }}</a>
          {{ $page->page_status == 'drafted' ? ' - 下書き' : ''}}
        </td>
        <td>{{ $page->page_name }}</td>
        <td class="nowrap">
          <a class="text-link" href="/admin/page/edit/{{ $page->page_name }}">編集</a>
          <span class="overTablet">|</span>
          <br class="forTablet">
          <button class="text-link" type="submit" name="deleteId" value="{{ $page->id }}">削除</button>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</form>

<div class="admin__index-pagination">
  {{ $pages->links() }}
</div>

@endsection