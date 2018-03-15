import React, { Component } from 'react';
import ReactDOM from 'react-dom';

export default function RightBlock(props) {
    let content;
    if(props.type){
        content = 
            <div>
                <Levels
                    block={props.block}
                    active_level={props.level}
                    style={props.style.levels}
                    update={props.update}
                />
                <Categorys
                    block={props.block}
                    level={props.level}
                    style={props.style.categorys}
                    update={props.update}
                    active_category={props.category}
                />
            </div>
        ;
    } else {
        content = 
            <div>
                <IndexCategorys
                    // categorys={props.categorys}
                    style={props.style.indexs}
                    update={props.update}
                    active_category={props.category}
                />
            </div>
        ;
    }

    return (
        <div style={props.style.style}>
            {content}
        </div>
    );
}

function Levels(props) {
    let levels = [];
    props.block.levels.forEach((value, i) => {
        levels.push(
            <Level
                level={value}
                active_color={props.block.colour}
                active_level={props.active_level}
                style={props.style.level}
                update={props.update}
                key={i}
            />);
    });
    return (
        <div style={props.style.style}>
            {levels}
        </div>
    );
}

function Level(props) {
    let color;
    color = props.active_level === props.level 
    ? {...props.style.style, backgroundColor: props.active_color, color: '#a3a3a3'}
    : props.style.style;
    
    let update = props.level.is_activated
    ? props.update.bind(this, {level: props.level})
    : null;

    return (
        <div
            style={color}
            onClick={update}
        >
            {props.level.name}
        </div>
    );
}

function Categorys(props) {
    let content;
    if(props.level.categorys){
        content = [];
        props.level.categorys.forEach((value, i) => {
            <Category
                category={value}
                update={props.update}
                style={props.style.category}
                active_category={props.category}
                key={i}
            />
        });
    } else {
        content = "Category based on level";
    }
    return (
        <div style={{...props.style.style, backgroundColor: props.block.colour}}>
            {content}
        </div>
    );
}

function IndexCategorys(props) {
    return (
        <div style={props.style.style}>
        </div>
    );
}

function Category(props) {
    return (
        <div style={props.style.style}>

        </div>
    );
}