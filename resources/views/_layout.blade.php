<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kiosk</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/semantic/semantic.min.css">
    <link rel="stylesheet" href="/css/kiosk.css">
    @yield('script')
</head>
<body>
    <div id="root"></div>
</body>
</html>