var TENS_LARANOTE = TENS_LARANOTE || {};

TENS_LARANOTE.AJAX = function($ajaxWrapper){
  this.$ajaxWrapper = $ajaxWrapper;
  this.init();

  // カテゴリー新規登録
  if (this.$ajaxWrapper.hasClass('ajax-wrapper__category')){
    storeCategory(this);
  // タグ新規登録
  } else if (this.$ajaxWrapper.hasClass('ajax-wrapper__tag')){
    storeTag(this);
  }

  function storeCategory($myself){
    var $category_title = $myself.$ajaxWrapper.find("input[name=category_title]"),
        $category_name = $myself.$ajaxWrapper.find("input[name=category_name]");

    $myself.$ajaxSubmit.on("click", $.proxy(function(){

      var $myself = this;

      $.ajax({
        url: '/admin/category/ajaxCreate',
        data: {
          category_title: $category_title.val(),
          category_name: $category_name.val()
        }
      })
      .done(function(data){
        $myself.$ajaxWrapper.css('display', 'none');
        $myself.$ajaxErrors.html('').css('display', 'none');
        $("select[name=category_id]").prepend(`<option value="${data.id}" selected>${data.title}</option>`);
        $category_title.val('');
        $category_name.val('');
      })
      .fail($.proxy(this.displayErros, $myself));

    }, $myself));

  }

  function storeTag($myself){
    var $tag_title = $myself.$ajaxWrapper.find("input[name=tag_title]"),
        $tag_name = $myself.$ajaxWrapper.find("input[name=tag_name]");

    $myself.$ajaxSubmit.on("click", $.proxy(function(){

      var $myself = this;
      $.ajax({
        url: '/admin/tag/ajaxCreate',
        data: {
          tag_title: $tag_title.val(),
          tag_name: $tag_name.val()
        }
      })
      .done(function(data){
        $myself.$ajaxWrapper.css('display', 'none');
        $myself.$ajaxErrors.html('').css('display', 'none');
        $(".select-tag").prepend(`
          <input type="checkbox" class="hidden form__checkbox-tag" id="tag${data.id}" name="tags[]" value="${data.id}}" checked>
          <label for="tag${data.id}" class="inline-block mr5 mb10">${data.title}</label>
          `);
        $tag_title.val('');
        $tag_name.val('');
      })
      .fail($.proxy(this.displayErros, $myself));

    }, $myself));

  }

};


TENS_LARANOTE.AJAX.prototype = {

  init : function(){
    this.setParameters();
    this.setupAjax();
    this.deleteValidation();
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
  },
  deleteValidation : function(){
    this.$ajaxWrapper.find("input").removeAttr("required max min maxlength pattern");
  }
};

$(function() {
  new TENS_LARANOTE.AJAX($('.ajax-wrapper__category'));
  new TENS_LARANOTE.AJAX($('.ajax-wrapper__tag'));
});