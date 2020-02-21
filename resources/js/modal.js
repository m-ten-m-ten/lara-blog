var TENS_LARANOTE = TENS_LARANOTE || {};

TENS_LARANOTE.MODAL = function($modalWrapper){
  this.$modalWrapper = $modalWrapper;
  this.init();
};

TENS_LARANOTE.MODAL.prototype = {

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
    new TENS_LARANOTE.MODAL($(this));
  });
});