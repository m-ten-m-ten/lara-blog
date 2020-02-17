let TENS = TENS || {};
TENS.LARANOTE = {};

TENS.LARANOTE.MODAL = function($modalWrapper){
  this.$modalWrapper = $modalWrapper;
  this.init();
};

TENS.LARANOTE.MODAL.prototype = {
  SLIDE_INTERVAL : 500,

  init : function(){
    this.setParameters();
    this.bindEvent();
  },
  setParameters : function(){
    this.$modalBody = this.$modalWrapper.find('.modal-body');
    this.$modalOpen = this.$modalWrapper.find('.modal-open');
    this.$modalClose = this.$modalWrapper.find('.modal-close');
  },
  bindEvent : function() {
    this.$modalOpen.on("click", $.proxy(this.openModal, this));
    this.$modalClose.on("click", $.proxy(this.closeModal, this));
  },
  openModal : function() {
    this.$modalBody.css("display", "block");
  },
  closeModal : function() {
    this.$modalBody.css("display", "none");
  }
};

$(function() {
  $('.modal-wrapper').each(function() {
    new TENS.LARANOTE.MODAL($(this));
  });
});