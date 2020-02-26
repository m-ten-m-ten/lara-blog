window.$ = window.jQuery = require('jquery');
// window.axios = require('axios');
// window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
require('./checkAll.js');
require('./modal.js');
require('./ajax.js');
import '@firstandthird/toc';
import { Accordion } from "./accordion.js";

$(function() {

  // スライドメニューの登録
  $('.accordion-wrapper').each(function() {
    new Accordion($(this));
  });

  // confirmクラスが付与されたformのsubmit時、アラートにて実行確認
  $('.confirm').submit(function () {
    if (!confirm('実行してよろしいですか？')) {
      return false;
    }
  });

});