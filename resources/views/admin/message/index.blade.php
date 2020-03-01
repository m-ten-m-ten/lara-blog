@extends('_includes._l-admin')
@section('jsAction', 'adminIndex')
@section('admin__title', 'メッセージ一覧')

@section('link-button')
  <a class="button" href="{{ route('admin.message.create') }}">新規作成</a>
@endsection

@section('admin__content')

<form class="confirm checkAll-wrapper" method="POST" action="/admin/message/delete" >
  @csrf
  @method('DELETE')

  <button class="button__inverse admin__index-batchSubmit batchSubmit" type="submit" name="checked" value="checked">一括削除</button>

  <table class="admin__index-table">
    <tr>
      <th><input class="checkAll-trigger" type="checkbox"></th>
      <th>あて先</th>
      <th>タイトル</th>
      <th class="overTablet">本文</th>
      <th></th>
    </tr>
    <tbody>
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

@endsection