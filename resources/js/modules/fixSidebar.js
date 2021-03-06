/**
 * サイドバーで追従要素(#sidebar__fixed)の制御
 */
export function fixSidebar() {

  const sidebar = $('#sidebar'),
        sticked = $('#sidebar__fixed'),
        main = $('#main');

  // サイドバー表示時に各値をセットするようにするため、ここでは宣言のみ。
  let sidebarTop,
      stickedOriginalTop,
      stickedHeight,
      notSetValue = true; //サイドバーが表示されて、各値がセットされたらfalseとする。

  $(window).on('load scroll resize', function(){

    if (sidebar.css('display') != 'none'){

      if (notSetValue) {
        sidebarTop = sidebar.offset().top,
        stickedOriginalTop = sticked.offset().top,
        stickedHeight = sticked.height();
        notSetValue = false;
      }

      let scrollTop = $(window).scrollTop(),
          contentBottom = main.offset().top + main.height();

      if ((scrollTop > stickedOriginalTop) && (scrollTop < contentBottom - stickedHeight)){
          sticked.css({
              'position': 'fixed',
              'top': 0,
              'width': sidebar.width()
          });
      } else if (scrollTop >= contentBottom - stickedHeight){
          sticked.css({
              'position': 'absolute',
              'top': contentBottom - stickedHeight,
              'width': sidebar.width()
          });
      } else {
          sticked.css('position', 'static');
      }

    }

  });

}