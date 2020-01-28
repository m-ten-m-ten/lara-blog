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