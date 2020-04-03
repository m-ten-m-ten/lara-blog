【{{ config('app.name') }}】の管理者様

いつも【{{ config('app.name') }}】をご利用頂きまして、ありがとうございます。

【{{ config('app.name') }}】に、下記内容のお問い合わせがありました。

----------------
【名前】
{{ $contact['name'] }} 様
【メールアドレス】
{{ $contact['email']?: '（未入力）' }}
【お問い合わせ内容】
{{ $contact['body'] }}
----------------

以上、よろしくお願い致します。

{{ config('app.name') }}
