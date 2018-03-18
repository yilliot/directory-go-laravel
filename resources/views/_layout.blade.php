<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kiosk</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('script')
</head>
<body>
    <div id="root"></div>
</body>
</html>