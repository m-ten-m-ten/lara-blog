export function confirmDelete() {
  $('.confirm').submit(function () {

    if (!confirm('実行してよろしいですか？')) {
      return false;
    }

  });
}
