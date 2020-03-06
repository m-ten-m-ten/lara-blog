export class Accordion {
  constructor($accordionWrapper) {
    this.$accordionWrapper = $accordionWrapper;
    this.$accordionBody = this.$accordionWrapper.children('.accordion-body:not(:animated)');
    this.$accordionTrigger = this.$accordionWrapper.children('.accordion-trigger');
    this.bindEvent();
  }

  bindEvent(){
    this.$accordionTrigger.on("click", $.proxy(this.slideMenu, this));
  }

  slideMenu(){
    if (this.$accordionBody.css("display") === "none") {
      this.$accordionBody.slideDown();
      this.$accordionTrigger.addClass('is-open');
    } else {
      this.$accordionBody.slideUp();
      this.$accordionTrigger.removeClass('is-open');
    }
  }
}