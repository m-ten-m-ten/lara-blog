【{{ config('app.name') }}】ご訪問者様

いつも【{{ config('app.name') }}】をご利用頂きまして、ありがとうございます。

【{{ config('app.name') }}】の管理者宛てに、下記内容のお問い合わせの送信が完了致しました。

----------------
【名前】
{{ $contact['name'] }} 様
【メールアドレス】
{{ $contact['email'] }}
【お問い合わせ内容】
{{ $contact['body'] }}
----------------

管理者からの返信をお待ち願います。
また、数日内に返信がない場合には、再度お問い合わせ頂きたく、よろしくお願い致します。

この度はお問い合わせ頂きまして、ありがとうございました。

{{ config('app.name') }}
{{ route('home') }}