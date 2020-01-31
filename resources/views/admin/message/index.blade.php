@extends('_includes._layout')
@section('content')

<div class="l-admin-index">

  {{-- 管理者画面ヘッダー --}}
  <div class="m-admin-header">
    <div class="m-admin-header-left">
      <h1 class="m-admin-header-title">メッセージ一覧</h1>
      <a class="m-button" href="{{ route('admin.message.create') }}">メッセージ作成</a>
    </div>
  </div>

  {{-- 管理者画面メイン --}}
  @include('_includes._m-status')

  <form id="delete-form" method="POST" action="/admin/message/delete" >
    @csrf
    @method('DELETE')

    <button id="multipleSubmitBtn" class="m-button--inverse m-admin-multiple-button" type="submit" name="checked" value="checked">一括削除</button>

    <table class="m-admin-table">
      <tr>
        <th><input type="checkbox" id="all"></th>
        <th>あて先</th>
        <th>タイトル</th>
        <th class="overTablet">本文</th>
        <th></th>
      </tr>
      <tbody id="boxes">
        @foreach ($messages as $message)
        <tr>
          <td><input type="checkbox" name="checkedIds[]" value="{{ $message->id }}"></td>
          <td>{{ $message->user->name }}</td>
          <td><a class="text-link" href="{{ route('admin.message.edit', $message->id) }}">{{ $message->title }}</a></td>
          <td class="overTablet">{{ Str::limit($message->content, 50) }}</td>
          <td class="nowrap">
            <a class="text-link" href="{{ route('admin.message.edit', $message->id) }}">編集</a>
            <span class="overTablet">|</span>
            <br class="forTablet">
            <button class="text-link" type="submit" name="deleteId" value="{{ $message->id }}">削除</button>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </form>

</div>
@endsection