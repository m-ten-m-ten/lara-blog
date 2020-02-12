@extends('_includes._l-admin')

@section('admin__title', 'タグ一覧')

@section('link-button')
  <a class="button" href="/admin/tag/create">新規追加</a>
@endsection

@section('admin__content')

<form id="delete-form" method="POST" action="/admin/tag/delete">
  @csrf
  @method('DELETE')

  <button id="multipleSubmitBtn" class="button__inverse admin__index-multiSubmit" type="submit" name="checked" value="checked">一括削除</button>

  <table class="admin__index-table">
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
        <td><a class="text-link" href="{{ route('admin.tag.edit', $tag->id)}}">{{ $tag->tag_title }}</a></td>
        <td>{{ $tag->tag_name }}</td>
        <td class="nowrap">
          <a class="text-link" href="{{ route('admin.tag.edit', $tag->id)}}">編集</a>
          <span class="overTablet">|</span>
          <br class="forTablet">
          <button class="text-link" type="submit" name="deleteId" value="{{ $tag->id }}">削除</button>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</form>

<div class="admin__index-pagination">
  {{ $tags->links() }}
</div>

@endsection