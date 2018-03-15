<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Kiosk</title>
</head>
<body>
  <script>
    let blocks = {!!$blocks!!};
    // console.log(blocks);
  </script>
  <script src="./js/app.js"></script>
  <div id="root"></div>
</body>
</html>