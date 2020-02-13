let TENS = TENS || {};
TENS.LARANOTE = {};

TENS.LARANOTE.CHECK_ALL = function($checkAllWrapper){
  this.$checkAllWrapper = $checkAllWrapper;
  this.init();
};

TENS.LARANOTE.CHECK_ALL.prototype = {

  init : function(){
    this.setParameters();
    this.bindEvent();
  },
  setParameters : function(){
    this.$checkAllTrigger = this.$checkAllWrapper.find('.checkAll-trigger');
    this.$checkbox = this.$checkAllWrapper.find("input[type='checkbox']:not('.checkAll-trigger')");
    this.$batchSubmit = this.$checkAllWrapper.find('.batchSubmit');
  },
  bindEvent : function(){
    this.$checkAllTrigger.on("click", $.proxy(this.checkAll, this));
    this.$checkbox.on("click", $.proxy(this.checkState, this));
    this.$batchSubmit.on("click", $.proxy(this.hasChecked, this));
  },

  // 全選択ボタンのチェック状態に選択ボタンを合わせる
  checkAll : function(){
    this.$checkbox.prop('checked', this.$checkAllTrigger.prop("checked"));
  },

  // 選択ボタンの状態により、全選択ボタンの状態を変更する
  checkState : function(){
    if(this.$checkbox.length === this.checkedbox().length){
      this.$checkAllTrigger.prop("checked", true);
    } else {
      this.$checkAllTrigger.prop('checked', false);
    }
  },

  // 一括処理ボタン押下時にチェック数が0の場合、アラート出してキャンセルする。
  hasChecked : function(){
    if(this.checkedbox().length === 0){
      alert('１つも選択されていません。')
      return false;
    }
  },

  // チェック済みの選択ボタンをものを返す。
  checkedbox : function(){
    let $checkedbox = $.grep(this.$checkbox, function(box){
      return $(box).prop("checked");
    });
    return $checkedbox;
  }
};

$(function() {
  $('.checkAll-wrapper').each(function() {
    new TENS.LARANOTE.CHECK_ALL($(this));
  });
});