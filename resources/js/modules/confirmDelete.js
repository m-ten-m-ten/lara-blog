// confirmクラスが付与されたformのsubmit時、アラートにて実行確認
export var confirmDelete = function() {
  $('.confirm').submit(function () {

    if (!confirm('実行してよろしいですか？')) {
      return false;
    }

  });
}
