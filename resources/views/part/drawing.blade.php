<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <script src="/js/drawing_tool.js"></script>
</head>
<body>
    <div>
        <input type="hidden" value="/storage/map_path/_0012_60 L3.jpg" id="map">
        <canvas width="1000px" height="700px" id="canvas"></canvas>
        <div style="position:fixed; top: 10px; left: 10px">
            <input type="text" id="text">
            <button id="redo">Redo</button>
            <button id="undo">Undo</button>
            <div>
                <button id="text-white"style="background-color: white">White</button>
                <button id="text-black" style="background-color: black">Black</button>
            </div>
            <button id="poligon-tool">Poligon</button>
            <button id="zoom-tool">Zoom</button>
            <button id="drag-tool">Drag</button>
            <button id="clear">Clear</button>
            <input type="number" id="font-size">
            <input type="text" id="font-color">
            <input type="text" id="data">
        </div>
    </div>
</body>
</html>