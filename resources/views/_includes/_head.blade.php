<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Styles -->
  <link href="/style/style.css" rel="stylesheet">
  <link href="/style/dracula.css" rel="stylesheet">

  <script src="/js/highlight.pack.js"></script>
  <script>hljs.initHighlightingOnLoad();</script>
  <script src="https://js.stripe.com/v3/"></script>

</head>