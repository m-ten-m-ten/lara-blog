//loadとresizeした時に実行
$(function(){
    $(window).on('load resize',function(){
        sideFixed();
    });
});

function sideFixed(){

    const sideInner = $('.sideInner');
    const side = $('.side');

    // sideのtop位置を取得
    const sideOffsetTop = side.offset().top;

    //sideの高さ
    const sideHeight = $('.side').outerHeight();

    //sideInnerの高さ
    const sideInnerHeight = $('.sideInner').outerHeight();


    //sideの下計算
    //sideの高さ + sideのtop開始位置 - ( sideInnerの高さ +[ sideのpadding-bottom:30px +  .sideInner.fixedのtop:30px分 ] )
    //1500 + 200 - ( 600 + 60 ) = 1140
    //1140pxスクロールしたら追従をやめる
    const sideBottom = sideHeight+sideOffsetTop-(sideInnerHeight+60);

    $(function(){
        function scrollPc() {
            const topScroll = $(window).scrollTop();

            if(topScroll>sideOffsetTop && topScroll<sideBottom){
                //スクロール値がsideのtop位置よりも大きい時かつ、
                //スクロール値が1140pxよりも小さい時

                // fixed
                sideInner.addClass('fixed');
                sideInner.removeClass('stop');
                side.css('vertical-align','top');

            }else if(topScroll>sideOffsetTop && topScroll>= sideBottom){
                //スクロール値がsideのtop位置よりも大きい時かつ、
                //スクロール値が1140pxと等しい、または大きい時

                //stop
                sideInner.removeClass('fixed');
                sideInner.addClass('stop');
                //table-cellなのでvertical-alignを使えます
                side.css('vertical-align','bottom');

            }else{
                //上記に当てはまらないもの
                //（スクロール値がsideのtop位置よりも小さい時）

                // top
                sideInner.removeClass('fixed');
                sideInner.removeClass('stop');
                side.css('vertical-align','top');
            }
            return false;
        }
        scrollPc();
        //スクロールした時に実行
        $(window).scroll(function(){
            scrollPc();
        });
    });
}

