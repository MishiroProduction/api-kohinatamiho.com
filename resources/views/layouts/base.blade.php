<!DOCTYPE html>
<html lang="ja">
<head>
    <title>Laravelサンプル</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <script src="{{ asset('js/app.js') }}"></script>
    @stack('js')
</head>
<body class="hold-transition sidebar-mini">
    @auth()
        @include('layouts.templates.auth')
    @endauth
    @guest()
        @include('layouts.templates.guest')
    @endguest
</body>
</html>
