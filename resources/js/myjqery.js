$(function() {

  // admin各機能indexページ 全選択/解除
  $('#all').on('click', function() {
    $("input[name='checkedIds[]']").prop('checked', this.checked);
  });
  $("input[name='checkedIds[]']").on('click', function() {
    if ($('#boxes :checked').length == $('#boxes :input').length) {
      $('#all').prop('checked', true);
    } else {
      $('#all').prop('checked', false);
    }
  });

  // admin各機能indexページ チェック有無チェック
  $('#multipleSubmitBtn').click(function (){
    if ($('#boxes :checked').length == 0) {
      alert('１つも選択されていません。')
      return false;
    }
  });

  // admin各機能indexページ キャンセル確認
  $('#delete-form').submit(function () {
    if (!confirm('本当に削除しますか？')) {
      alert('キャンセルされました');
      return false;
    }
  });

  // ヘッダーメニューのスライド
  $('#menu01').click(function() {
    if($('#menu01-sub').hasClass('open')){
      $('#menu01-sub').slideUp();
      $('#menu01-sub').removeClass('open');
    } else {
      $('#menu01-sub').slideDown();
      $('#menu01-sub').addClass('open');
    }
  });
  $('#menu02').click(function() {
    if($('#menu02-sub').hasClass('open')){
      $('#menu02-sub').slideUp();
      $('#menu02-sub').removeClass('open');
    } else {
      $('#menu02-sub').slideDown();
      $('#menu02-sub').addClass('open');
    }
  });
  $('#menu03').click(function() {
    if($('#menu03-sub').hasClass('open')){
      $('#menu03-sub').slideUp();
      $('#menu03-sub').removeClass('open');
    } else {
      $('#menu03-sub').slideDown();
      $('#menu03-sub').addClass('open');
    }
  });

  $('#tag_btn').click(function() {
    if($('#tag_menu').hasClass('open')){
      $('#tag_menu').slideUp();
      $('#tag_menu').removeClass('open');
    } else {
      $('#tag_menu').slideDown();
      $('#tag_menu').addClass('open');
    }
  });

  // ドロップダウンメニュー
  const $navigation = $('.dropdown-menu');
  const $navigationToggle = $('.dropdown-toggle');

  $navigationToggle.click(function() {
    if($navigation.hasClass('open')) {
      $navigation.slideUp();
      $navigation.removeClass('open');
      $navigationToggle.removeClass('is-active');
    } else {
      $navigation.slideDown();
      $navigation.addClass('open');
      $navigationToggle.addClass('is-active');
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

  // 選択済みのサムネイルの表示
  let src = $('input[name="image_id"]:checked').next().children('img').attr('src');
  $("#selected_thumb_img").attr("src", src);

  $('input[name="image_id"]:radio').change(function(){
    let src = $(this).next().children('img').attr('src');
    $("#selected_thumb_img").attr("src", src);
  });

});

