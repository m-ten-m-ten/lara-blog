export class AjaxCommon {
  constructor($ajaxWrapper){
    this.setParameters($ajaxWrapper);
    this.setupAjax();
    this.deleteValidation($ajaxWrapper);
  }

  setParameters($ajaxWrapper){
    this.$ajaxSubmit = $ajaxWrapper.find('.ajax-submit');
    this.$ajaxErrors = $ajaxWrapper.find('.ajax-errors');
  }

  setupAjax(){
    $.ajaxSetup({
        method: 'post',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        context: this
    });
  }

  deleteValidation($ajaxWrapper){
    $ajaxWrapper.find("input").removeAttr("required max min maxlength pattern");
  }

  displayErrors(data){
      this.$ajaxErrors.html('').css('display', 'block');
      $.each(data.responseJSON.errors, (function(key, val) {
        this.$ajaxErrors.prepend(`<li>${val}</li>`);
      }.bind(this)));
  }
}