$(function() {
  /* -------------------------------------------------------
    記事の見出しから目次作成
  --------------------------------------------------------*/
  function makeMokuji() {

    var idcount = 1;  // IDのカウント
    var mokuji = '';  // 目次のHTML格納場所
    var currentlevel = 0  // 見出しのレベル初期値

    // 見出しを回してリストに格納
    $('article h2, article h3, article h4').each(function(i){

      // 見出しごとにIDを保存
      this.id = 'chapter-' + idcount;
      idcount ++;

      // 見出しのレベル設定
      var level = 0;
      if(this.nodeName.toLowerCase() == 'h2') {
        level = 1;
      } else if(this.nodeName.toLowerCase() == 'h3') {
        level = 2;
      } else if(this.nodeName.toLowerCase() == 'h4') {
        level = 3;
      }

      // 見出しのレベルが現在のレベルよりも数値が大きければ
      // <ol>を追加して入れ子にする
      while(currentlevel < level) {
        mokuji += '<ol class="chapter">';
        
        currentlevel ++;
      }

      // そうでなければ</ol>で閉じて入れ子を終了する
      while(currentlevel > level) {
        mokuji += '</ol>';
        currentlevel --;
      }

      // リストを生成
      mokuji += '<li><a href="#' + this.id + '">' + $(this).html() + '</a></li>\n';
    });

    // 現在のレベルが0より上ならリストを閉じる
    while(currentlevel > 0) {
      mokuji += '</ol>';
      currentlevel --;
    }

    // HTML出力
    strMokuji = '<h4>目次で流し読みする <span class="kao">･*･:≡(ε:)</span></h4>\
           <div class="mokujiInner">'
            + mokuji +
           '<!-- /.mokujiInner --></div>';

    $('.mokuji').html(strMokuji);

    /* -------------------------------------------------------
      リストクリックでスムーズスクロール
    --------------------------------------------------------*/
    $('.mokuji li').click(function(){
      var speed = 800;
      var href = $(this).find('a').attr('href');
      var target = $(href == '#' || href == '' ? 'html' : href);
      var position = target.offset().top;
      $('html, body').stop().animate({scrollTop:position}, speed, 'easeInOutCirc');
      return false;
    });

  }
  makeMokuji();
});

jQuery(function($){
  // 目次の出力に使用する変数
  var toc = '<h2>目次</h2><ol>';
  // 目次の階層の判断に使用する変数
  var hierarchy;
  // h2・h3の判断に使用する変数
  var element = 0;
  // 目次の項目数をカウントする変数
  var count = 0;

    $('#toc-range h2, #toc-range h3').each(function(){
      // 目次の項目数のカウントを増加
    count ++;
    // h2・h3タグにIDの属性値を指定
    this.id = 'chapter-' + count;

    // 現在のループで扱う要素を判断する条件分岐
    if(this.nodeName == 'H2'){
      element = 0;
    }else{
      element = 1;
    }

    // 現在の状態を判断する条件分岐
    if(hierarchy === element){ // h2またはh3がそれぞれ連続する場合
      toc += '</li>';
    }else if(hierarchy < element){ // h2の次がh3となる場合
      toc += '<ol>';
      hierarchy = 1;
    }else if(hierarchy > element){ // h3の次がh2となる場合
      toc += '</li></ol></li>';
      hierarchy  = 0;
    }else if(count == 1){ // 最初の項目の場合
      hierarchy = 0;
    }

    // 目次の項目を作成。※次のループで<li>の直下に<ol>タグを出力する場合ががあるので、ここでは<li>タグを閉じていません。
    toc += '<li><a href="#' + this.id + '">' + $(this).html() + '</a>';
  });

  // 目次の最後の項目をどの要素から作成したかにより、タグの閉じ方を変更
  if(element == 0){
    toc += '</li></ol>';
  }else if(element == 1){
    toc += '</li></ol></li></ol>';
  }

  // ページ内のh2・h3タグが3つ以上の場合に目次を出力
  if(count < 3){
    $('#toc').remove();
  }else{
    $('#toc').html(toc);
  }
});