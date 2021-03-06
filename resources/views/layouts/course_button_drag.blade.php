<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Project LEO</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.1/css/bulma.min.css">
    <link rel="stylesheet" href="/css/lessonpage.css">
    <link rel="stylesheet" href="/plugin/codemirror/lib/codemirror.css">
    <link rel="stylesheet" href="/plugin/codemirror/theme/shadowfox.css">
    <link rel="stylesheet" href="/plugin/codemirror/addon/hint/show-hint.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css">
    <link rel="stylesheet" href="/plugin/glider/css/glider.css" />
    <script src="/js/jquery.min.js"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/vue@2.6.12"></script>
    <script defer src="/js/app.js"></script>
    <!-- <script defer src="/js/carousel.js"></script> -->
    <script defer src="/js/button-drag.js"></script>
    <script src="/plugin/confetti/confetti.js"></script>
    <script src="/plugin/glider/js/glider.min.js"></script>
</head>
<body>
    <div id="app" class="has-background-white-ter">
    <navbardash :user="{{ Auth::user() }}" route="{{ route('logout') }}" csrf="{{csrf_token()}}"></navbardash>
        <div class="container is-fluid">
                @yield('content')
        </div>
	</div>
</body>
</html>
