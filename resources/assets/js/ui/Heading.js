import React, { Component } from 'react';
import ReactDOM from 'react-dom';

export default function Heading(props) {
    return props.type
    ? <div id="block-heading">
        <div style={{display: 'flex'}}>
            <HeaderBlock
                text={props.block.name}
                color={props.block.colour}
                textColor='text-white'
            />
            <HeaderBlock
                text={props.level.name}
                textColor='text-grey'
            />
        </div>
    </div>
    :
    <div id="block-heading-index">
        <HeaderBlock
            text='INDEX'
            textColor='text-white'
            color='#666'
        />
    </div>
    ;
}

function HeaderBlock(props) {
    if(props.color){
        return (
            <div className={props.textColor + ' heading-font'} style={{backgroundColor: props.color}}>
                {props.text}
            </div>
        )
    } else {
        return (
            <div className={props.textColor + ' heading-font'}>
                {props.text}
            </div>
        )
    }
}