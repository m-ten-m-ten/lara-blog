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
  const $navigation = $('.dropdown_menu');
  const $navigationToggle = $('.dropdown_toggle');

  $navigationToggle.click(function() {
    if($navigation.hasClass('open')) {
      $navigation.slideUp();
      $navigation.removeClass('open');
    } else {
      $navigation.slideDown();
      $navigation.addClass('open');
    }
  });

  // modal
  const $modalOpen = $('#modal-open');
  const $modalClose = $('#modal-close');
  const $modal = $('#modal');

  $modalOpen.click(function() {
    $modal.css('display', 'block');
  });
  $modalClose.click(function() {
    $modal.css('display', 'none');
  });

  // 選択したサムネイルの表示
  let src = $('input[name="post_thumbnail"]:checked').next().children('img').attr('src');
  let name = $('input[name="post_thumbnail"]:checked').next().children('div').text();
  $("#selected_thumb_img").attr("src", src);
  $("#selected_thumb_name").text(name);

  $('input[name="post_thumbnail"]:radio').change(function(){
    let src = $(this).next().children('img').attr('src');
    let name = $(this).next().children('div').text();
    $("#selected_thumb_img").attr("src", src);
    $("#selected_thumb_name").text(name);
  });

});

