/**
 * Toc(Table of contents)目次の作成、及び、遷移アニメーションを制御。
 */
export class Toc {

  /**
   * インスタンスプロパティのセット、インスタンスメソッドの呼び出し。
   * @param  String article 目次対象のエリアを指定。
   * @param  String tocBody 作成した目次を埋め込む要素名を指定。
   */
  constructor(article, tocBody) {
    this.$tocBody = $(tocBody);
    this.$tocElements = $(article).find('h2, h3, h4'); //目次対象要素
    this.makeToc();
    this.smoothScroll();
  }

  /**
   * 目次対象要素にidを追加。及び、目次の作成と埋め込み。
   */
  makeToc() {
    let tocList = '';

    if(this.$tocElements.length > 0){
      tocList = '<ul>';

      this.$tocElements.each( (i, tocElement) => {
        const tocId = `toc-${i}`,
              tocClass = `toc-${tocElement.nodeName.toLowerCase()}`;

        $(tocElement).attr('id', tocId);

        tocList += `<li class="${tocClass}"><a href="#${tocId}">${$(tocElement).text()}</a></li>`;
      });

      tocList += '</ul>';
      this.$tocBody.html(tocList);

    }
  }

  /**
   * 目次内のリンククリック時のアニメーション指定。
   */
  smoothScroll() {
    this.$tocBody.find('li a').click(function(event) {
        event.preventDefault();
        const position = $($(this).attr('href')).offset().top,
              speed = 500;
        $('html, body').animate({scrollTop:position}, speed);
      });
  }
}