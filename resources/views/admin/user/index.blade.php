@extends('_includes._layout')
@section('content')

<div class="l-admin-index">

  {{-- 管理者画面ヘッダー --}}
  <div class="m-admin-header">
    <div class="m-admin-header-left">
      <h1 class="m-admin-header-title">ユーザー一覧</h1>
    </div>
  </div>

  <table class="m-admin-table">
    <tr>
      <th>名前</th>
      <th>メールアドレス</th>
      <th>メッセージ数</th>
      <th></th>
    </tr>

    <tbody>
      @foreach($users as $user)
        <tr>
          <td>{{ $user->name }}</td>
          <td>{{ $user->email }}</td>
          <td>{{ $user->messages_count }}</td>
          <td class="nowrap"><button type="button" class="text-link del_btn" data-id="{{ $user->id }}" value="削除">削除</button></td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>

@stop