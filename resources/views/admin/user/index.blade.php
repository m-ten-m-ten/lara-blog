@extends('_includes._layout')
@section('content')

<div class="l-admin-index">

  {{-- 管理者画面ヘッダー --}}
  <div class="m-admin-header">
    <div class="m-admin-header-left">
      <h1 class="m-admin-header-title">ユーザー一覧</h1>
    </div>
  </div>

    {{-- 管理者画面メイン --}}

  @include('_includes._m-status')

  <form id="delete-form" method="POST" action="/admin/user/delete">
  @csrf
  @method('DELETE')

    <button id="multipleSubmitBtn" class="m-button--inverse m-admin-multiple-button" type="submit" name="checked" value="checked">一括削除</button>

    <table class="m-admin-table">
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

  <div class="m-admin-pagination">
    {{ $users->links() }}
  </div>

</div>
@endsection