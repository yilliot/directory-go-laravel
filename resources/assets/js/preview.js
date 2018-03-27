const $ = require('jquery');

multilineToArray = function(text) {
    let result = [];
    let now = 0;
    while(text.indexOf('\r\n') != -1) {
        result.push(text.slice(0, text.indexOf('\r\n')));
        text = text.slice(text.indexOf('\r\n') + 2);
    }
    while(text.indexOf('\n') != -1) {
        result.push(text.slice(0, text.indexOf('\n')));
        text = text.slice(text.indexOf('\n') + 1);
    }
    result.push(text);
    return result;
}

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
        return true;
    } else return false;

}

function drawText(ctx, area, width, height) {

    if(!area){return null}
    // Check if it is assigned
    if(!Array.isArray(JSON.parse(area.area_json))) {
        let area_json = JSON.parse(area.area_json);
        let c = area_json.canvasSize;

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
            multiline = multilineToArray(text);
            let center_line;
            for(let i in multiline) {
                let line_text = multiline[i];
                if(i == 0) center_line = parseInt(ctx.measureText(line_text).width)/2;
                let centralize = parseInt(ctx.measureText(line_text).width)/2;
                let offset = (-parseInt(text_size)/ c.w * width * (multiline.length - 1) / 2) + parseInt(text_size)/ c.w * width * i;
                ctx.fillText(line_text, x / c.w * width - centralize + center_line , y / c.h * height + offset);
            }
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
            area_jsons.forEach((area) => {
                drawText(this.ctx, area, this.canvas.width, this.canvas.height)
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
