import { AjaxCommon } from './AjaxCommon';

export class AjaxCategory extends AjaxCommon {
  constructor(){
    const $ajaxWrapper = $('.ajax-wrapper__category');
    super($ajaxWrapper);
    this.$ajaxWrapper = $ajaxWrapper;
    this.$category_title = $ajaxWrapper.find("input[name=category_title]");
    this.$category_name = $ajaxWrapper.find("input[name=category_name]");
    this.$ajaxSubmit.on("click", $.proxy(this.storeCategory, this));
  }

  storeCategory(){
    const $myself = this;

    $.ajax({
      url: '/admin/category/ajaxCreate',
      data: {
        category_title: $myself.$category_title.val(),
        category_name: $myself.$category_name.val()
      }
    })
    .done(function(data){
      $myself.$ajaxWrapper.css('display', 'none');
      $myself.$ajaxErrors.html('').css('display', 'none');
      $("select[name='category_id']").find('option').removeAttr('selected');
      $('.dummy-option').after(`<option value="${data.id}" selected>${data.title}</option>`);
      $myself.$category_title.val('');
      $myself.$category_name.val('');
    })
    .fail($.proxy(super.displayErrors, $myself));
  }
}