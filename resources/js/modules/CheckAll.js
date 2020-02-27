export class CheckAll {
  constructor($checkAllWrapper){
    this.$checkAllWrapper = $checkAllWrapper;
    this.$checkAllTrigger = this.$checkAllWrapper.find('.checkAll-trigger');
    this.$checkbox = this.$checkAllWrapper.find("input[type='checkbox']:not('.checkAll-trigger')");
    this.$batchSubmit = this.$checkAllWrapper.find('.batchSubmit');
    this.bindEvent();
  }

  bindEvent(){
    this.$checkAllTrigger.on("click", $.proxy(this.checkAll, this));
    this.$checkbox.on("click", $.proxy(this.checkState, this));
    this.$batchSubmit.on("click", $.proxy(this.hasChecked, this));
  }

  // 全選択ボタンのチェック状態に選択ボタンを合わせる
  checkAll(){
    this.$checkbox.prop('checked', this.$checkAllTrigger.prop("checked"));
  }

  // 選択ボタンの状態により、全選択ボタンの状態を変更する
  checkState(){
    if(this.$checkbox.length === this.checkedbox().length){
      this.$checkAllTrigger.prop("checked", true);
    } else {
      this.$checkAllTrigger.prop('checked', false);
    }
  }

  // チェック済みのチェックボックスを返す。
  checkedbox(){
    let $checkedbox = $.grep(this.$checkbox, function(box){
      return $(box).prop("checked");
    });
    return $checkedbox;
  }

  // 一括処理ボタン押下時にチェック数が0の場合、アラート出してキャンセルする。
  hasChecked(){
    if(this.checkedbox().length === 0){
      alert('１つも選択されていません。')
      return false;
    }
  }

}