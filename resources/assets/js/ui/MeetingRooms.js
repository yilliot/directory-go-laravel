import React, { Component } from 'react';
import ReactDOM from 'react-dom';

export default function MeetingRooms(props) {
    let content = [];
    let meetingrooms = props.meetingrooms;
    let j = 0;
    while(Object.keys(meetingrooms).length - j > 0) {
        let list = [];
        for (var k = 0; k < 26; k++) {
            if(Object.keys(meetingrooms)[j + k] != 'name' && Object.keys(meetingrooms)[j + k]) {
                list.push(meetingrooms[Object.keys(meetingrooms)[j + k]]);
            }
        }
        j += 26;
        content.push(
            <List key={j} list={list} style={props.style.list} activate={props.activate}/>
        );
    }

    return (
        <div id="meeting-room">
            <div className="lists">{content}</div>
        </div>
    );
}

function List(props) {
    let content = [];
    for(let i in props.list) {
        content.push(
            <Row area={props.list[i]} activate={props.activate} key={i}/>
            );
    }
    if(content.length) {
        return (
            <div className="list">
                <div style={{display: "flex", justifyContent: 'flex-end'}}>
                    <div className="list-row-btn-group">
                        <div className="list-column list-column01">BLK</div>
                        <div className="list-column list-column02">LVL</div>
                        <div className="list-column list-column03">RM</div>
                    </div>
                </div>
                {content}
            </div>
        );
    } else {
        return (
            <div>
            </div>
        );
    }

}

function Row(props) {
    return (
        <div className="list-row" onClick={props.activate.bind(this, props.area.block, props.area.level, props.area.category)}>
            {props.area.name}
            <div className="list-row-btn-group">
                <div className="list-column list-column01" style={{backgroundColor: props.area.bg_colour}}>{props.area.block}</div>
                <div className="list-column list-column02" style={{backgroundColor: props.area.bg_colour}}>{props.area.level}</div>
                <div className="list-column list-column03">{props.area.name_display}</div>
            </div>
        </div>
    );
}