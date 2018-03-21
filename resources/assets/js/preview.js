const $ = require('jquery');

function drawArea(ctx, area, width, height) {

    if(!area){return null}
    // Check if it is assigned
    if(!Array.isArray(JSON.parse(area.area_json))) {
        let area_json = JSON.parse(area.area_json);
        let c = area_json.canvasSize;
        let points = area_json.geometry.points;
        let offset = {x: area_json.geometry.x, y: area_json.geometry.y};
        if(points) {
            ctx.beginPath();
            let area_color = area_json.geometry.color;
            ctx.fillStyle = area_color;
            ctx.strokeStyle = area_color;
            // console.log(points, area_color);
            ctx.globalAlpha = 0.6;        
            ctx.translate(offset.x / c.w * width, offset.y / c.h * height)
            points.forEach((point, index) => {
                if(index == 0)ctx.moveTo(point.x / c.w * width, point.y / c.h * height);
                else ctx.lineTo(point.x / c.w * width, point.y / c.h * height);
            });
            ctx.fill();
            ctx.translate(-offset.x / c.w * width, -offset.y / c.h * height)
            ctx.globalAlpha = 1;
        }

        let text = area_json.text.text;
        if(text) {
            let text_color = area_json.text.color;
            let text_size = area_json.text.size;
            let x = area_json.text.x;
            let y = area_json.text.y;

            ctx.beginPath();
            // console.log(text);
            ctx.font = parseInt(text_size)/ c.w * width + 'px' + ' stencil';
            ctx.fillStyle = text_color;
            ctx.fillText(text, x / c.w * width , y / c.h * height);
            ctx.fill();
        }
        return true;
    } else return false;

}

window.onload = function() {

    Preview = new Object;

    Preview.canvas = document.getElementById('canvas');
    Preview.mapSrc = document.getElementById('map');

    Preview.ctx = this.canvas.getContext('2d');

    Preview.map = new Image();
    Preview.map.src = Preview.mapSrc.value;
    Preview.map.onload = () => {
        Preview.render();
    }
    Preview.render = function() {
        this.ctx.drawImage(this.map, 0, 0, this.canvas.width, this.canvas.height)
        if(area_jsons) {
            area_jsons.forEach((area) => {
                drawArea(this.ctx, area, this.canvas.width, this.canvas.height)
            });
        }
    }

    if(document.getElementById('select_category')) {
        let category_id = document.getElementById('select_category').value;

        area_jsons = areas_by_category[category_id];
        Preview.render();

        $('#select_category').on('change', function(event) {
            category_id = this.value;
            area_jsons = areas_by_category[category_id];
            Preview.render();
        });
    }

}
