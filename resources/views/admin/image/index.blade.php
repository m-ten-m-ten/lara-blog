@extends('_includes._l-admin')

@section('admin__title', '画像一覧')

@section('link-button')
  <a class="button" href="/admin/image/create">新規追加</a>
@endsection

@section('admin__content')

<form id="delete-form" method="POST" action="/admin/image/delete">
@csrf
@method('DELETE')

  <button id="multipleSubmitBtn" class="button__inverse admin__index-multiSubmit" type="submit" name="checked" value="checked">一括削除</button>


  <table class="admin__index-table">
    <tr>
      <th><input type="checkbox" id="all"></th>
      <th>画像</th>
      <th>ファイル名</th>
      <th class="md:w-32 w-16">登録日</th>
      <th></th>
    </tr>
    <tbody id="boxes">
      @foreach ($images as $image)
      <tr>
        <td><input type="checkbox" name="checkedIds[]" value="{{ $image->id }}"></td>
        <td><img src="{{ $image->path }}" alt="" width="100px"></td>
        <td><a class="text-link" href="{{ route('admin.image.edit', $image->id)}}">{{ $image->file_name }}</a></td>
        <td>{{ $image->created_at->format('Y/m/d H:i') }}</td>
        <td class="nowrap">
          <a class="text-link" href="{{ route('admin.image.edit', $image->id)}}">編集</a>
          <span class="overTablet">|</span>
          <br class="forTablet">
          <button class="text-link" type="submit" name="deleteId" value="{{ $image->id }}">削除</button>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</form>

<div class="admin__index-pagination">
  {{ $images->links() }}
</div>

@endsection