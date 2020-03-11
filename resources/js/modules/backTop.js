/**
 * backTopクラス要素の制御
 */
export function backTop() {
  const backTop = $('.backTop');

  // backTopクラス要素をクリックすると、ページトップへスクロール。
  backTop.click(function() {
    $('html, body').animate({scrollTop: 0}, 500);
  });

  // backTopクラス要素の出現制御
  $(window).on('scroll', function(){
    const triggerPoint = 100;
    let scrollTop = $(window).scrollTop();

    if(scrollTop <= triggerPoint){
      backTop.removeClass('backTop__visible');
    } else {
      backTop.addClass('backTop__visible');
    }
  });

}