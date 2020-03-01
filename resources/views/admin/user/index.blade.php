@extends('_includes._l-admin')

@section('jsAction', 'adminIndex')
@section('admin__title', 'ユーザー一覧')

@section('admin__content')

<form class="confirm checkAll-wrapper" method="POST" action="/admin/user/delete">
  @csrf
  @method('DELETE')

  <button class="button__inverse admin__index-batchSubmit batchSubmit" type="submit" name="checked" value="checked">一括削除</button>

  <table class="admin__index-table">
    <tr>
      <th><input class="checkAll-trigger" type="checkbox"></th>
      <th>名前</th>
      <th class="overSP">メールアドレス</th>
      <th class="overTablet">メッセージ数</th>
      <th></th>
    </tr>
    <tbody>
      @foreach ($users as $user)
      <tr>
        <td><input type="checkbox" name="checkedIds[]" value="{{ $user->id }}"></td>
        <td>
          {{ $user->name }}
          <br class="forSP">
          <span class="forSP text-xs">{{ $user->email }}</span>
        </td>
        <td class="overSP">{{ $user->email }}</td>
        <td class="overTablet">{{ $user->messages_count }}</td>
        <td class="nowrap">
          <button class="text-link" type="submit" name="deleteId" value="{{ $user->id }}">削除</button>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</form>

<div class="admin__index-pagination">
  {{ $users->links() }}
</div>

@endsection