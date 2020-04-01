require('tinymce');
require('tinymce/themes/silver');
require('tinymce/plugins/lists');
require('tinymce/plugins/link');
require('tinymce/plugins/image');
require('tinymce/plugins/code');
require('tinymce/plugins/fullscreen');
require('tinymce/plugins/media');
require('tinymce/plugins/table');

require('tinymce-i18n/langs/ja');

export class Tinymce {

  constructor() {
    tinymce.init({
      selector: "#tinymce_content", //これが一番上じゃないとだめ。
      body_class: "article__body", //エディターのbodyに付与したいclass。（スタイル適用のため）
      content_css: "/style/style.css", //publicのスタイルシートを指定。
      content_style: "body {margin: 15px;}", //指定したクラスの親に全体の余白系を指定しているなら、エディターのbodyに指定。
      language: "ja",
      plugins: "table lists link image fullscreen media code",
      menubar: "false",
      toolbar: ['undo redo | code | blockquote | bold | styleselect | forecolor backcolor | fontsizeselect','numlist bullist | table | link | image | media | removeformat | fullscreen'],
      fontsize_formats: '10px 12px 14px 16px 18px 20px 24px 34px',
      branding: false,
      image_list: "/admin/post/read_image_api", //イメージのリストをJSONで出力。postContrller@readImage参照。
      relative_urls: false, // 相対パスに変換されるのを防ぐ
    });
  }
}
