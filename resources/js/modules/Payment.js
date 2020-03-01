export class Payment {
    constructor(){
        /* 基本設定*/
        this.stripe = window.Stripe('pk_test_iec7brwPyq9swQpeNe9jtz9z00SFvgURSv');
        this.elements = this.stripe.elements();
        this.style = {
                base: {
                    fontSize: '15px'
                }
            };
        this.classes = {
                base: 'form__input-stripe'
            };

        /* フォームでdivタグになっている部分をStripe Elementsを使ってフォームに変換 */
        this.cardNumber = this.elements.create('cardNumber', {
            style: this.style,
            classes: this.classes,
            placeholder: 'カード番号 1234 1234 1234 1234'
        });
        this.cardNumber.mount('#cardNumber');

        this.cardCvc = this.elements.create('cardCvc', {
            style: this.style,
            classes: this.classes,
            placeholder: 'セキュリティ番号'
        });
        this.cardCvc.mount('#securityCode');

        this.cardExpiry = this.elements.create('cardExpiry', {
            style: this.style,
            classes: this.classes,
            placeholder: '有効期限 MM/YY'
        });
        this.cardExpiry.mount('#expiration');

        this.formPayment = $('#form_payment');
        this.bindEvent();
    }

    bindEvent() {
        this.formPayment.submit(function(e){
            this.storeStripe(e)
        }.bind(this));
    }

    storeStripe(e){
        console.log('Payment.storeStripeのthis');
        console.log(this);
        e.preventDefault();
        this.stripe.createToken(this.cardNumber,{name: $('#cardName').val()}).then(function(result) {

            /* errorが返ってきた場合はその旨を表示 */
            if (result.error) {
                alert("カード登録処理時にエラーが発生しました。カード番号が正しいものかどうかをご確認いただくか、別のクレジットカードで登録してみてください。");
            } else {

            /* 暗号化されたコードが返ってきた場合は以下のStripeTokenHandler関数を実行。その際、引数として暗号化されたコードを渡してあげる。 */
                this.stripeTokenHandler(result.token);
            }
        }.bind(this));
    }

    stripeTokenHandler(token) {
        // const hiddenInput = document.createElement('input');
        // hiddenInput.setAttribute('type', 'hidden');
        // hiddenInput.setAttribute('name', 'stripeToken');
        // hiddenInput.setAttribute('value', token.id);
        // this.formPayment.appendChild(hiddenInput);
        console.log('Payment.stripeTokenHandlerのthis');
        console.log(this);
        this.formPayment.append($(`<input type="hidden" name="stripeToken" value="${token.id}">`));
        this.formPayment.submit();
    }
}
