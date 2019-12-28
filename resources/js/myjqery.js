$(function() {

  // index 全選択
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

  // public ヘッダー スライドメニュー
  $('#category_btn').click(function() {
    if($('#category_menu').hasClass('open')){
      $('#category_menu').slideUp();
      $('#category_menu').removeClass('open');
    } else {
      $('#category_menu').slideDown();
      $('#category_menu').addClass('open');
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

  // 選択済みのサムネイルの表示
  let src = $('input[name="image_id"]:checked').next().children('img').attr('src');
  let name = $('input[name="image_id"]:checked').next().children('div').text();
  $("#selected_thumb_img").attr("src", src);
  $("#selected_thumb_name").text(name);

  $('input[name="image_id"]:radio').change(function(){
    let src = $(this).next().children('img').attr('src');
    let name = $(this).next().children('div').text();
    $("#selected_thumb_img").attr("src", src);
    $("#selected_thumb_name").text(name);
  });

});

