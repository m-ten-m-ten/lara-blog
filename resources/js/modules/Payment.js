export class Payment {

    constructor(){
        this.formPayment = $('#form_payment');
        this.stripe = window.Stripe(this.formPayment.data('key'));
        this.setStripeElements();
        this.bindEvent();
    }

    setStripeElements() {
        const $elements = this.stripe.elements();
        const $classes = {
                base: 'form__input-stripe',
            };
        /* フォームでdivタグになっている部分をStripe Elementsを使ってフォームに変換 */
        this.cardNumber = $elements.create('cardNumber', {
            classes: $classes,
            placeholder: 'カード番号 1234 1234 1234 1234'
        });
        this.cardNumber.mount('#cardNumber');

        const $cardCvc = $elements.create('cardCvc', {
            classes: $classes,
            placeholder: 'セキュリティ番号'
        });
        $cardCvc.mount('#securityCode');

        const $cardExpiry = $elements.create('cardExpiry', {
            classes: $classes,
            placeholder: '有効期限 MM/YY'
        });
        $cardExpiry.mount('#expiration');
    }

    bindEvent() {
        this.formPayment.find("button[type='submit']").on("click", event => {
            this.storeStripe(event)
        });
    }

    storeStripe(event){
        event.preventDefault();

        // $elementsのインスタンスをトークン化。引数として渡すのはelementsのうちの一つで良い。
        // 第２引数はoptionのdataとして、カード名義を送信。stripe公式でもカード名義の送信はrecommendしてる。
        this.stripe.createToken(this.cardNumber, {name: $('#cardName').val()}).then( result => {

            if (result.error) {
                /* errorが返ってきた場合はその旨を表示 */
                alert("カード登録処理時にエラーが発生しました。カード番号が正しいものかどうかをご確認いただくか、別のクレジットカードで登録してみてください。");
            } else {
                /* エラーが無ければ、戻り値のトークンを"stripeToken"の値にセットしてsubmit処理。 */
                this.formPayment.append($(`<input type="hidden" name="stripeToken" value="${result.token.id}">`));
                this.formPayment.submit();
            }
        });
    }

}
