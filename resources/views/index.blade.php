<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Kiosk</title>
</head>
<body>
  <script>
    let blocks = {!!$blocks->toJson()!!};
    console.log(blocks);
    
  </script>
  <script src="./js/app.js"></script>
  <div id="root"></div>
</body>
</html>