@extends('_includes._layout')
@section('content')

<div class="l-admin-index">

  {{-- 管理者画面ヘッダー --}}
  <div class="m-admin-header">
    <div class="m-admin-header-left">
      <h1 class="m-admin-header-title">画像一覧</h1>
      <a class="m-button" href="/admin/image/create">新規追加</a>
    </div>
  </div>

  {{-- 管理者画面メイン --}}
  @include('_includes._m-status')

  <form id="delete-form" method="POST" action="/admin/image/delete">
  @csrf
  @method('DELETE')

    <button id="multipleSubmitBtn" class="m-button--inverse m-admin-multiple-button" type="submit" name="checked" value="checked">一括削除</button>


    <table class="m-admin-table">
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

  <div class="m-admin-pagination">
    {{ $images->links() }}
  </div>

</div>
@endsection