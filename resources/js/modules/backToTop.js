/**
 * backToTopクラス要素の制御
 */
export function backToTop() {
  const backToTop = $('.backToTop');

  // backToTopクラス要素をクリックすると、ページトップへスクロール。
  backToTop.click(function() {
    $('html, body').animate({scrollTop: 0}, 500);
  });

  // backToTopクラス要素の出現制御
  $(window).on('scroll', function(){
    const triggerPoint = 100;
    let scrollTop = $(window).scrollTop();

    if(scrollTop <= triggerPoint){
      backToTop.removeClass('backToTop__visible');
    } else {
      backToTop.addClass('backToTop__visible');
    }
  });

}