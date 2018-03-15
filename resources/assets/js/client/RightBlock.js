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
    : props.level.is_activated
    ? props.style.style
    : {...props.style.style, backgroundColor: '#666666'};
    
    let category;
    let zone_categories = props.level.zone_categories;
    let area_categories = props.level.area_categories;
    if(zone_categories) {
        category = zone_categories[Object.keys(zone_categories)[0]];
    }else if(area_categories) {
        category = area_categories[Object.keys(area_categories)[0]];
    }
    
    let update = props.level.is_activated
    ? props.update.bind(this, {level: props.level, category: category})
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
    let content = [];
    console.log(props, props.level);
    let zone_categories = props.level.zone_categories;
    let area_categories = props.level.area_categories;
    if(zone_categories) {
        content.push(
            <Category
                category={zone_categories[Object.keys(zone_categories)[0]]}
                update={props.update}
                style={props.style.category}
                active_category={props.category}            
                key="zone"
            />);
    }
    if(area_categories) {
        for(let x in area_categories){
            content.push(
                <Category
                    category={area_categories[x]}
                    update={props.update}
                    style={props.style.category}
                    active_category={props.category}            
                    key={x}
                />);
        }
    }
    // let content;
    // if(props.level.categorys){
    //     content = [];
    //     props.level.categorys.forEach((value, i) => {
    //         <Category
    //             category={value}
    //             update={props.update}
    //             style={props.style.category}
    //             active_category={props.category}
    //             key={i}
    //         />
    //     });
    // } else {
    //     content = "Category based on level";
    // }
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
        <div
            style={props.style.style}
            onClick={props.update.bind(this, {category: props.category})}
        >
            {props.category.name}
        </div>
    );
}