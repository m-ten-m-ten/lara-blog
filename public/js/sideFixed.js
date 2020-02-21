var TENS_LARANOTE = TENS_LARANOTE || {};

TENS_LARANOTE.SIDE_FIXED = {

  init : function(){
    this.fixSidebar();
  },
  fixSidebar : function() {
    const sidebar = $('#sidebar'),
        sticked = $('#sidebar__fixed'),
        main = $('#main'),
        sidebarTop = sidebar.offset().top,
        stickedOriginalTop = sticked.offset().top,
        stickedHeight = sticked.height();

    $(window).on('scroll resize', function(){
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
                'top': contentBottom - stickedHeight - sidebarTop,
                'width': sidebar.width()
            });
        } else {
            sticked.css('position', 'static');
        }
    });
  }
};

$(function() {
    TENS_LARANOTE.SIDE_FIXED.init();
});