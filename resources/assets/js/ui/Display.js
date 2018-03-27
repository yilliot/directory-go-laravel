import React, { Component } from 'react';
import ReactDOM from 'react-dom';

import IndexDisplay from './IndexDisplay';

export default function Display(props) {

    if(props.type) {
        let areas = props.category.zones ? props.category.zones : props.category.areas;
        let pointer = props.level.id == props.pointer.level_id ? props.pointer: null;
        return (
            <div id='display'>
                <Canvas areas={areas} building_core={props.level.building_core} pointer={props.pointer} direction={props.direction} pointer={pointer} src={props.level.map_path} blocks={props.blocks}/>
            </div>
        );
    } else {
        return (
            <div>
                <IndexDisplay
                    style={props.style.indexdisplay}
                    activate={props.activate}
                    category={props.category}
                />
            </div>
        );
    }
}

class Canvas extends Component {

    constructor(props) {
        super(props);
        this.handleClick = this.handleClick.bind(this);
        this.state = {
            canvas: null,
            ctx: null,
            ready: false,
            first: true,
            imgs: null,
        }
    }

    componentWillReceiveProps() {
        // this.setState({first: true}); // On receive props meaning new map need refresh
    }

    componentDidMount() {
        let imgs = {};
        for(let i in this.props.blocks) {
            let block = this.props.blocks[i];
            for(let j in block.levels) {
                let level = block.levels[j];
                if(level.map_path) {
                    let img = new Image();
                    img.src = '/storage/' + level.map_path;
                    imgs[level.map_path] = img;
                }
            }
        }
        this.setState({
            canvas: this.refs.canvas,
            ctx: this.refs.canvas.getContext('2d'),
            ready: true,
            imgs: imgs,
        });
        // console.log(imgs);
    }

    handleClick(event) {
        let coor = {};
        if (this.props.direction) {
            coor.x = this.state.canvas.width - event.nativeEvent.offsetX;
            coor.y = this.state.canvas.height - event.nativeEvent.offsetY;
        } else {
            coor.x = event.nativeEvent.offsetX;
            coor.y = event.nativeEvent.offsetY;
        }
        console.log(JSON.stringify({x: coor.x, y:coor.y}));
    }

    render() {
        if(this.state.ready) {
            let { canvas, ctx, direction, imgs } = this.state;
            // map
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            if(this.props.direction) {
                ctx.rotate(Math.PI);
                ctx.translate(-canvas.width, -canvas.height);
            }
            if(this.state.first) {
                imgs[this.props.src].onload = () => {
                ctx.drawImage(imgs[this.props.src], 0, 0, canvas.width, canvas.height);
                this.setState({first: false});
                }
            }
            else ctx.drawImage(imgs[this.props.src], 0, 0, canvas.width, canvas.height);


            if(this.props.areas) {
                this.props.building_core.forEach((area, index) => {
                    // console.log(area);
                    drawArea(ctx, area, canvas.width, canvas.height, this.props.direction);
                });
                this.props.building_core.forEach((area, index) => {
                    // console.log(area);
                    drawText(ctx, area, canvas.width, canvas.height, this.props.direction);
                });
                this.props.areas.forEach((area, index) => {
                    // console.log(area);
                    drawArea(ctx, area, canvas.width, canvas.height, this.props.direction);
                });
                this.props.areas.forEach((area, index) => {
                    // console.log(area);
                    drawText(ctx, area, canvas.width, canvas.height, this.props.direction);
                });
            }
            if(this.props.pointer) drawPointer(ctx, pointer.json, canvas.width, canvas.height, this.props.direction);
            if(this.props.direction) {
                ctx.rotate(Math.PI);
                ctx.translate(-canvas.width, -canvas.height);
            }

        }

        return (
            <canvas onClick={this.handleClick} ref="canvas" width="1431" height="1012" />
        );
    }
}

function multilineToArray(text) {
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

function drawArea(ctx, area, width, height, direction) {
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

function drawText(ctx, area, width, height, direction) {
    // Check if it is assigned
    if(!Array.isArray(JSON.parse(area.area_json))) {
        let area_json = JSON.parse(area.area_json);
        let c = area_json.canvasSize;

        let text = area_json.text.text;
        if(text) {
            if(direction) {
                ctx.rotate(Math.PI);
                ctx.translate(-width, -height);
            }
            let text_color = area_json.text.color;
            let text_size = area_json.text.size;
            let x = area_json.text.x;
            let y = area_json.text.y;

            ctx.beginPath();
            ctx.font = (parseInt(text_size) / c.w * width) + 'px stencil';
            ctx.fillStyle = text_color;
            let multiline = multilineToArray(text);
            let center_line;
            for(let i in multiline) {
                let line_text = multiline[i];
                if(i == 0) center_line = parseInt(ctx.measureText(line_text).width)/2;
                let centralize = parseInt(ctx.measureText(line_text).width)/2;
                let offset = (-parseInt(text_size)/ c.w * width * (multiline.length - 1) / 2) + parseInt(text_size)/ c.w * width * i;
                if(direction) ctx.fillText(line_text, width - ctx.measureText(line_text).width - 4 - x / c.w * width + centralize - center_line , height + (parseInt(text_size) / c.w * width) / 2 - (y / c.h * height) + offset);
                else ctx.fillText(line_text, x / c.w * width - centralize + center_line , y / c.h * height + offset);
            }

            ctx.fill();
            if(direction) {
                ctx.rotate(Math.PI);
                ctx.translate(-width, -height);
            }
        }
        return true;
    } else return false;

}

function drawPointer(ctx, json, width, height, direction) {
    let c = json.c;
    if(direction) {
        ctx.rotate(Math.PI);
        ctx.translate(-width, -height);
    }

    let pointer = new Image();
    pointer.src = '/images/you-are-here.png';
    let pointer_width = 25;
    let pointer_height = 45;
    pointer.onload = function() {
        if(direction) ctx.drawImage(this, width - json.x - pointer_width/2, height - json.y - pointer_height, pointer_width, pointer_height)
        else ctx.drawImage(this, json.x - pointer_width/2, json.y - pointer_height, pointer_width, pointer_height);
    }

    if(direction) {
        ctx.rotate(Math.PI);
        ctx.translate(-width, -height);
    }
}