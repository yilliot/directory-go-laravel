import React, { Component } from 'react';
import ReactDOM from 'react-dom';

import IndexDisplay from './IndexDisplay';

export default function Display(props) {

    if(props.type) {
        let areas = props.category.zones ? props.category.zones : props.category.areas;
        let pointer = props.level.id == props.pointer.level_id ? props.pointer: null;
        return (
            <div id='display'>
                <Canvas areas={areas} pointer={props.pointer} direction={props.direction} pointer={pointer} src={props.level.map_path}/>
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
            first: true
        }
    }

    componentWillReceiveProps() {
        this.setState({first: true}); // On receive props meaning new map need refresh
    }

    componentDidMount() {
        this.setState({
            canvas: this.refs.canvas,
            ctx: this.refs.canvas.getContext('2d'),
            ready: true
        });
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
            let { canvas, ctx, direction } = this.state;
            // map
            let img = new Image();
            img.src = '/storage/' + this.props.src;
            if(this.props.direction) {
                ctx.rotate(Math.PI);
                ctx.translate(-canvas.width, -canvas.height);
            }
            if(this.state.first) {
                img.onload = () => {
                ctx.drawImage(img, canvas.width, canvas.height);
                this.setState({first: false});
                }
            }
            else ctx.drawImage(img, 0, 0, canvas.width, canvas.height);

            if(this.props.areas) {
                this.props.areas.forEach((area, index) => {
                    // console.log(area);
                    drawArea(ctx, area, canvas.width, canvas.height, this.props.direction);
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
            if(direction) ctx.fillText(text, width - ctx.measureText(text).width - 4 - x / c.w * width , height + (parseInt(text_size) / c.w * width) / 2 - (y / c.h * height));
            else ctx.fillText(text, x / c.w * width , y / c.h * height);
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