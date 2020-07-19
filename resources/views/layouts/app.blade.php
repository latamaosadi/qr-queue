<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>QR Queue</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    @yield('style')
</head>
<body class="bg-gray-200">
    <div class="container mx-auto bg-white min-h-screen shadow-xl">
        @yield('content')
    </div>
    <script src="{{ mix('js/app.js') }}"></script>
    @yield('script')
</body>
</html>