window.$ = window.jQuery = require('jquery');
// window.axios = require('axios');
// window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
require('./accordion.js');
require('./checkAll.js');
require('./modal.js');
require('./ajax.js');
import '@firstandthird/toc';


// 軽めの処理を下記にまとめて記述
$(function() {

  // confirmクラスが付与されたformのsubmit時、アラートにて実行確認
  $('.confirm').submit(function () {
    if (!confirm('実行してよろしいですか？')) {
      return false;
    }
  });

});