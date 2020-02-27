export class Modal {
  constructor($modalWrapper) {
    this.$modalWrapper = $modalWrapper;
    this.$modalBody = this.$modalWrapper.find('.modal-body');
    this.$modalOpen = this.$modalWrapper.find('.modal-open');
    this.$modalClose = this.$modalWrapper.find('.modal-close');
    this.bindEvent();
  }

  bindEvent() {
    this.$modalOpen.on("click", $.proxy(this.openModal, this));
    this.$modalClose.on("click", $.proxy(this.closeModal, this));
  }

  openModal() {
    this.$modalBody.css("display", "block");
  }

  closeModal() {
    this.$modalBody.css("display", "none");
  }

}