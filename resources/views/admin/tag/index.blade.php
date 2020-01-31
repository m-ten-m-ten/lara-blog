@extends('_includes._layout')
@section('content')

<div class="l-admin-index">

  {{-- 管理者画面ヘッダー --}}
  <div class="m-admin-header">
    <div class="m-admin-header-left">
      <h1 class="m-admin-header-title">タグ一覧</h1>
      <a class="m-button" href="/admin/tag/create">新規追加</a>
    </div>
  </div>

  {{-- 管理者画面メイン --}}
  @include('_includes._m-status')

  <form id="delete-form" method="POST" action="/admin/tag/delete">
  @csrf
  @method('DELETE')

    <button id="multipleSubmitBtn" class="m-button--inverse m-admin-multiple-button" type="submit" name="checked" value="checked">一括削除</button>

    <table class="m-admin-table">
      <tr>
        <th><input type="checkbox" id="all"></th>
        <th>タグ</th>
        <th>スラッグ</th>
        <th></th>
      </tr>
      <tbody id="boxes">
        @foreach ($tags as $tag)
        <tr>
          <td><input type="checkbox" name="checkedIds[]" value="{{ $tag->id }}"></td>
          <td><a href="/admin/tag/edit/{{ $tag->id }}">{{ $tag->tag_title }}</a></td>
          <td>{{ $tag->tag_name }}</td>
          <td class="nowrap">
            <a class="text-link" href="/admin/tag/edit/{{ $tag->id }}">編集</a>
            <span class="overTablet">|</span>
            <br class="forTablet">
            <button class="text-link" type="submit" name="deleteId" value="{{ $tag->id }}">削除</button>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </form>

  <div class="m-admin-pagination">
    {{ $tags->links() }}
  </div>

</div>
@endsection