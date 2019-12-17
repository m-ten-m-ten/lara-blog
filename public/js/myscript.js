// index 削除時のアラート
function delete_alert(e){
   if(!window.confirm('本当に削除しますか？')){
      window.alert('キャンセルされました');
      return false;
   }
   document.deleteform.submit();
};


$(function() {

// index 全選択
  // 1. 「全選択」する
  $('#all').on('click', function() {
    $("input[name='checked_id[]']").prop('checked', this.checked);
  });
  // 2. 「全選択」以外のチェックボックスがクリックされたら、
  $("input[name='checked_id[]']").on('click', function() {
    if ($('#boxes :checked').length == $('#boxes :input').length) {
      // 全てのチェックボックスにチェックが入っていたら、「全選択」 = checked
      $('#all').prop('checked', true);
    } else {
      // 1つでもチェックが入っていたら、「全選択」 = checked
      $('#all').prop('checked', false);
    }
  });

// nav トグルメニュー
  var $navigation = $('.dropdown-menu ul');
  var $navigationToggle = $('.dropdown-toggle');

  $navigationToggle.click(function() {

    if($navigation.hasClass('open')) {
      $navigation.slideUp();
      $navigation.removeClass('open');
    } else {
      $navigation.slideDown();
      $navigation.addClass('open');
    }
  });

});