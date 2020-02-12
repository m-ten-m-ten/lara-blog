@extends('_includes._l-admin')

@section('admin__title', 'ユーザー一覧')

@section('admin__content')

<form id="delete-form" method="POST" action="/admin/user/delete">
  @csrf
  @method('DELETE')

  <button id="multipleSubmitBtn" class="button__inverse admin__index-multiSubmit" type="submit" name="checked" value="checked">一括削除</button>

  <table class="admin__index-table">
    <tr>
      <th><input type="checkbox" id="all"></th>
      <th>名前</th>
      <th class="overSP">メールアドレス</th>
      <th class="overTablet">メッセージ数</th>
      <th></th>
    </tr>
    <tbody id="boxes">
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