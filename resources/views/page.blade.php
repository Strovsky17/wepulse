<!DOCTYPE html>
<html lang="en">
<head>
    <base href="/">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    
    <title>WePulse</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body class='BO'>    
    
    <script> window.tableLang = { ... {!! json_encode( __('table') ) !!} }  </script>

    @yield('sidebar')
    <div class='content'>
        @yield('topbar')
        @yield('content')
    </div>
</body>
</html>