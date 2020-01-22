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
          <td class="nowrap"><button type="button" class="text-link" data-id="{{ $user->id }}" value="削除">削除</button></td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>
<script>
// データの削除
jQuery(function ($) {

    /**
     * 削除用AJAX
     */
    function deleteRecord(url, btn) {
        $.ajax({
            url: url,
            data: {_method: "DELETE"},
            method: "post"
        }).done(function () {
            $(btn).closest("tr").remove();
        }).fail(function (xhr, str1, str2) {
            alert("データの削除に失敗しました");
        });
    }

    /**
     * 削除ボタンが押されたら、削除用AJAXを呼び出す
     */
    $("table").on("click", ".del_btn", function () {
        var url = "{{ route('admin.user.destroy', '') }}/" + $(this).data("id");

        deleteRecord(url, this);
    });

    // CSRFトークンの設定
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});
</script>
@stop