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
            <List key={j} list={list} style={props.style.list}/>
        );
    }

    return (
        <div>{content}</div>
    );
}

function List(props) {
    let content = [];
    for(let i in props.list) {
        content.push(
            <Row area={props.list[i]} key={i}/>
            );
    }
    return (
        <div style={props.style.style}>
            <div>BLK LVL RM</div>
            {content}
        </div>
    )

}

function Row(props) {
    return (
        <div>
            {props.area.name_display}
        </div>
    );
}