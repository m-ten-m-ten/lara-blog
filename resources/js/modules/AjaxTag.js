import { AjaxCommon } from './AjaxCommon';

export class AjaxTag extends AjaxCommon {
  constructor(){
    const $ajaxWrapper = $('.ajax-wrapper__tag');
    super($ajaxWrapper);
    this.$ajaxWrapper = $ajaxWrapper;
    this.$tag_title = $ajaxWrapper.find("input[name=tag_title]");
    this.$tag_name = $ajaxWrapper.find("input[name=tag_name]");
    this.$ajaxSubmit.on("click", $.proxy(this.storeTag, this));
  }

  storeTag(){
    const $myself = this;

    $.ajax({
      url: '/admin/tag/ajaxCreate',
      data: {
        tag_title: $myself.$tag_title.val(),
        tag_name: $myself.$tag_name.val()
      }
    })
    .done(function(data){
      $myself.$ajaxWrapper.css('display', 'none');
      $myself.$ajaxErrors.html('').css('display', 'none');
      $(".select-tag").prepend(`
          <input type="checkbox" class="hidden form__checkbox-tag" id="tag${data.id}" name="tags[]" value="${data.id}" checked>
          <label for="tag${data.id}" class="inline-block mr5 mb10">${data.title}</label>
          `);
      $myself.$tag_title.val('');
      $myself.$tag_name.val('');
    })
    .fail($.proxy(super.displayErrors, $myself));
  }
}