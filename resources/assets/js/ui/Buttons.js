import React, { Component } from 'react';
import ReactDOM from 'react-dom';

export default function Buttons(props) {
    let buttons = [];
    buttons.push(
        <IndexButton
            key="index"
            style={props.style.button}
            update={props.update}
            index={props.index}
        />);
    props.blocks.forEach((value, i) => {
        buttons.push(
            <BlockButton
                block={value}
                active_block={props.block}
                key={i}
                style={props.style.button}
                update={props.update}
                active_category={props.category}
            />);
    });
    return (
        <div style={props.style.style}>
            {buttons}
        </div>
    );
}

function BlockButton(props) {
    let first_active_level, first = 1;
    props.block.levels.forEach((value) => {
        if(value.is_activated && first) {
            first_active_level = value;
            first = 0;
        }
    });
    let category = props.active_category;
    for(let y in props.block.levels) {
        let zone_categories = props.block.levels[y].is_activated ? props.block.levels[y].zone_categories: null;
        let area_categories = props.block.levels[y].is_activated ? props.block.levels[y].area_categories: null;
        if(zone_categories) {
            category = zone_categories[Object.keys(zone_categories)[0]];
            break;
        }else if(area_categories) {
            category = area_categories[Object.keys(area_categories)[0]];
            break;
        }
    }

    let update = props.active_block !== props.block
    ? props.update.bind(this, {block: props.block, type: 1, level: first_active_level, category: category})
    : null;
    return (
        <div
            style={{backgroundColor: props.block.colour, ...props.style.style}}
            onClick={update}
        >
            {props.block.name}
        </div>
    );
}

function IndexButton(props) {
    return (
        <div
            style={{backgroundColor: '#666666', ...props.style.style}}
            onClick={props.update.bind(this, {type: 0, block: props.index, category: props.index[Object.keys(props.index)[0]]})}
        >
            Index
        </div>
    );
}