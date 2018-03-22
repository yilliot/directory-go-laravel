import React, { Component } from 'react';
import ReactDOM from 'react-dom';

export default function BlockView(props) {
    let content = [];
    let blocks = props.kampongs ? props.kampongs: props.facilities;
    let isKampongs = props.kampongs ? 1: 0;
    for(let i in blocks) {
        if(i != 'name') {
            let block = Object.assign({}, blocks[i]);
            let j = 0;
            // console.log(Object.keys(block.levels).length > 4);
            while(Object.keys(block.levels).length - j > 0) {
                let levels = [];
                for(let k = 0; k < 6; k++) {
                    if(Object.keys(block.levels)[j + k])levels.push(block.levels[Object.keys(block.levels)[j + k]]);
                }
                j += 6;
                content.push(
                    <Block key={i + j} levels={levels} isKampongs={isKampongs} name={block.name} style={props.style.block} bg_colour={block.bg_colour} activate={props.activate}/>
                );
            }
        }
    }

    return (
        <div id="index-display">{content}</div>
    );
}

function Block(props) {
    let content = [];
    for(let i in props.levels) {
        let level = props.levels[i];
        content.push(
            <Level level={level} key={i} style={props.style.level} bg_colour={props.bg_colour} isKampongs={props.isKampongs} activate={props.activate}/>
            );
    }
    let roof;
    switch(props.name) {
        case '60':
            roof = <Roof style={props.style.roof} comment="70.L7"/>;
            break;
        case '70':
            roof = <Roof style={props.style.roof} comment="80.L9"/>;
            break;
    }
    return (
        <div className="block">
            <div className="label" style={{backgroundColor: props.bg_colour}}>{props.name}</div>
            {content}
            {roof}
        </div>
    );
}

function Roof(props) {
    return (
        <div className="roof" style={{backgroundColor: '#e6e5e6'}}>
            <div className="roof-name">ROOF<br/>GARDEN</div>
            <div className="comment">ACCESS<br/>FROM {props.comment}</div>
        </div>
    );
}

function Level(props) {
    let content;
    if(props.isKampongs) {
        content = <Zones style={props.style.zones} zones={props.level.zones} activate={props.activate}/>
    } else {
        content = <Zones style={props.style.zones} zones={props.level.areas} activate={props.activate}/>
    }
    return (
        <div className="level" style={{position: 'relative'}}>
            <div className="level-name">{props.level.name}</div>
            {content}
            <div style={{position: 'absolute', opacity: '0.2', zIndex: '-2', width: "100%", height: '100%', backgroundColor: props.level.is_activated ? props.bg_colour: '#a3a3a3'}} />
        </div>
    );
}

function Zones(props) {
    let content = [];
    props.zones.forEach((zone, i) => {
        if(zone.name_display) {
            content.push(
                <Zone
                    activate={props.activate}
                    style={props.style.zone}
                    zone={zone}
                    key={i}
                />);
        }
    });
    return (
        <div className="index-zones">
            {content}
        </div>
    );
}

function Zone(props) {
    return (
        <div className={"index-zone" + (props.zone.bg_colour? '':' facility')} onClick={props.activate.bind(this, props.zone.block, props.zone.level, props.zone.category)} style={{backgroundColor: props.zone.bg_colour? props.zone.bg_colour: 'white'}}>
            {props.zone.name_display}
        </div>
    );
}