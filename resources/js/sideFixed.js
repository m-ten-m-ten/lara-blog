let TENS = TENS || {};
TENS.LARANOTE = {};

TENS.LARANOTE.SIDE_FIXED = function(){
  this.init();
};

TENS.LARANOTE.SIDE_FIXED.prototype = {

  init : function(){
    this.setParameters();
    this.bindEvent();
  },
  setParameters : function(){
    this.sidebar = $('#sidebar');
    this.sideFixed = this.sidebar.find('#sidebar__fixed');
    this.main = $('#main');

    this.sidebar_top = this.sidebar.offset().top;
    this.sideFixed_top = this.sideFixed.offset().top;
    this.sideFixed_height = this.sideFixed.height();

  },
  bindEvent : function() {
    $(window).on('scroll resize', $.proxy(this.chase, this));
  },
  chase : function() {
    this.scrollTop = $(window).scrollTop();
    this.contentBottom = this.main.offset().top + this.main.height();
    if ((this.scrollTop > this.sideFixed_top) && (this.scrollTop < this.contentBottom - this.sideFixed_height)){
        this.sideFixed.css({
            'position': 'fixed',
            'top': 0,
            'width': this.sidebar.width()
        });
    } else if(this.scrollTop >= this.contentBottom - this.sideFixed_height){
        this.sideFixed.css({
            'position': this.contentBottom - this.sideFixed_height -this.sidebar_top,
            'top': 0,
            'width': this.sidebar.width()
        });
    } else {
        this.sideFixed.css('position', 'static');
    }
  }
};

$(function() {
    new TENS.LARANOTE.SIDE_FIXED();
});