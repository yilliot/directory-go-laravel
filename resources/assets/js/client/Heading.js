import React, { Component } from 'react';
import ReactDOM from 'react-dom';

export default function Heading(props) {
    let content = props.type
    ? <div style={{display: 'flex'}}>
        <HeaderBlock
            style={props.style.block}
            text={props.block.name}
            color={props.block.colour}
        />
        <HeaderBlock
            style={props.style.level}
            text={props.level.name}
        />
      </div>
    : <HeaderBlock
        style={props.style.index}
        text={'Index'}
      />
    ;
    return (
        <div style={props.style.style}>
            {content}
        </div>
    );
}

function HeaderBlock(props) {
    if(props.color){
        return (
            <div style={{...props.style.style, backgroundColor: props.color}}>
                {props.text}
            </div>
        )
    } else {
        return (
            <div style={props.style.style}>
                {props.text}
            </div>
        )
    }
}