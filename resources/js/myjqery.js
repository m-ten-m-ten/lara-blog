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
  var $navigation = $('.dropdown_menu');
  var $navigationToggle = $('.dropdown_toggle');

  $navigationToggle.click(function() {

    if($navigation.hasClass('open')) {
      $navigation.slideUp();
      $navigation.removeClass('open');
      $navigationClose.removeClass('is-active');
      $(this).removeClass('is-active');
    } else {
      $navigation.slideDown();
      $navigation.addClass('open');
      $navigationClose.addClass('is-active');
      $(this).addClass('is-active');
    }
  });
});