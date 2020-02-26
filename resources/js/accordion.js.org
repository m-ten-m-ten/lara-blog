let TENS = TENS || {};
TENS.LARANOTE = {};

TENS.LARANOTE.ACCORDION = function($accordionWrapper){
  this.$accordionWrapper = $accordionWrapper;
  this.init();
};

TENS.LARANOTE.ACCORDION.prototype = {
  SLIDE_TIME : 500,

  init : function(){
    this.setParameters();
    this.bindEvent();
  },
  setParameters : function(){
    this.$accordionBody = this.$accordionWrapper.children('.accordion-body:not(:animated)');
    this.$accordionTrigger = this.$accordionWrapper.children('.accordion-trigger');
  },
  bindEvent : function() {
    this.$accordionTrigger.on("click", $.proxy(this.slideMenu, this));
  },
  slideMenu : function() {
    if (this.$accordionBody.css("display") === "none") {
      this.$accordionBody.slideDown(this.SLIDE_TIME);
      this.$accordionTrigger.addClass('is-open');
    } else {
      this.$accordionBody.slideUp(this.SLIDE_TIME);
      this.$accordionTrigger.removeClass('is-open');
    }
  }
};

$(function() {
  $('.accordion-wrapper').each(function() {
    new TENS.LARANOTE.ACCORDION($(this));
  });
});
