import React, { Component } from 'react';
import ReactDOM from 'react-dom';

export default function Display(props) {

    let areas = props.category.zones ? props.category.zones : props.category.areas;
    
    return (
        <div style={props.style.style}>
            <Canvas areas={areas} direction={props.direction} src={props.level.map_path}/>
        </div>
    );
}

class Canvas extends Component {

    constructor(props) {
        super(props);
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
            if(this.props.direction) {
                ctx.rotate(Math.PI);
                ctx.translate(-canvas.width, -canvas.height);
            }

        }

        return (
            <canvas ref="canvas" width="1431" height="1012" />
        );
    }
}

function drawArea(ctx, area, width, height, direction) {
    // Check if it is assigned
    if(!Array.isArray(JSON.parse(area.area_json))) {
        let area_json = JSON.parse(area.area_json);
        let c = area_json.canvasSize;
        let points = area_json.geometry.points;
        if(points) {
            ctx.beginPath();
            let area_color = area_json.geometry.color;
            ctx.fillStyle = area_color;
            ctx.strokeStyle = area_color;
            // console.log(points, area_color);
            ctx.globalAlpha = 0.6;        
            points.forEach((point, index) => {
                if(index == 0)ctx.moveTo(point.x / c.w * width, point.y / c.h * height);
                else ctx.lineTo(point.x / c.w * width, point.y / c.h * height);
            });
            ctx.fill();
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
            // console.log(text);
            ctx.font = text_size + ' Georgia';
            ctx.fillStyle = text_color;
            if(direction) ctx.fillText(text, width - ctx.measureText(text).width - x / c.w * width , height - (y / c.h * height));
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