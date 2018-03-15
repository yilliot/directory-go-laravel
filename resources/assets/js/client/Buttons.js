import React, { Component } from 'react';
import ReactDOM from 'react-dom';

export default function Buttons(props) {
    let buttons = [];
    buttons.push(
        <IndexButton
            key="index"
            style={props.style.button}
            update={props.update}
        />);
    props.blocks.forEach((value, i) => {
        buttons.push(
            <BlockButton
                block={value}
                active_block={props.block}
                key={i}
                style={props.style.button}
                update={props.update}
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

    let update = props.active_block !== props.block
    ? props.update.bind(this, {block: props.block, type: 1, level: first_active_level})
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
            onClick={props.update.bind(this, {type: 0, block: null})}
        >
            Index
        </div>
    );
}