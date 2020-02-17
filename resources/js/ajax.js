let TENS = TENS || {};
TENS.LARANOTE = {};

TENS.LARANOTE.AJAX = function($ajaxWrapper){
  this.$ajaxWrapper = $ajaxWrapper;
  this.init();

  // カテゴリー新規登録
  if (this.$ajaxWrapper.hasClass('ajax-wrapper__category')){
    this.$category_title = this.$ajaxWrapper.find("input[name=category_title]");
    this.$category_name = this.$ajaxWrapper.find("input[name=category_name]");
    this.$ajaxSubmit.on("click", $.proxy(function(){
      $.ajax({
        url: '/admin/category/ajaxCreate',
        data: {
          category_title: this.$category_title.val(),
          category_name: this.$category_name.val()
        }
      })
      .done($.proxy(function(data){
        this.$ajaxWrapper.css('display', 'none');
        this.$ajaxErrors.html('').css('display', 'none');
        $("select[name=category_id]").prepend(`<option value="${data.id}" selected>${data.title}</option>`);
        this.$category_title.val("");
        this.$category_name.val("");
      }), this)
      .fail($.proxy(this.displayErros, this));
    }, this));

  // タグ新規登録
  } else if (this.$ajaxWrapper.hasClass('ajax-wrapper__tag')){
    this.$tag_title = this.$ajaxWrapper.find("input[name=tag_title]");
    this.$tag_name = this.$ajaxWrapper.find("input[name=tag_name]");
    this.$ajaxSubmit.on("click", $.proxy(function(){
      $.ajax({
        url: '/admin/tag/ajaxCreate',
        data: {
          tag_title: this.$tag_title.val(),
          tag_name: this.$tag_name.val()
        }
      })
      .done($.proxy(function(data){
        this.$ajaxWrapper.css('display', 'none');
        this.$ajaxErrors.html('').css('display', 'none');
        $(".select-tag").prepend(`
          <input type="checkbox" class="hidden form__checkbox-tag" id="tag${data.id}" name="tags[]" value="${data.id}}">
          <label for="tag${data.id}" class="inline-block mr5 mb10">${data.title}</label>
          `);
        this.$tag_title.val("");
        this.$tag_name.val("");
      }), this)
      .fail($.proxy(this.displayErros, this));
      }, this));
    }
};

TENS.LARANOTE.AJAX.prototype = {

  init : function(){
    this.setParameters();
    this.setupAjax();
  },
  setParameters : function(){
    this.$ajaxSubmit = this.$ajaxWrapper.find('.ajax-submit');
    this.$ajaxErrors = this.$ajaxWrapper.find('.ajax-errors');
  },
  displayErros : function(data){
      this.$ajaxErrors.html('').css('display', 'block');
      $.each(data.responseJSON.errors, (function(key, val) {
        this.$ajaxErrors.prepend(`<li>${val}</li>`);
      }.bind(this)));
  },
  setupAjax : function(){
    $.ajaxSetup({
        method: 'post',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        context: this
    });
  }
};

$(function() {
  new TENS.LARANOTE.AJAX($('.ajax-wrapper__category'));
  new TENS.LARANOTE.AJAX($('.ajax-wrapper__tag'));
});