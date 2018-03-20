import React, { Component } from 'react';
import ReactDOM from 'react-dom';

import MeetingRooms from './MeetingRooms';
import BlockView from './BlockView';

export default function IndexDisplay(props) {
    switch(props.category.name) {
        case'Kampongs Index':
            return (<BlockView style={props.style.blocks} kampongs={props.category}/>);
            break;
        case'Facilities Index':
            return (<BlockView style={props.style.blocks} facilities={props.category} />);
            break;
        case'Meeting Rooms Index [A - G]':
        case'Meeting Rooms Index [H - O]':
        case'Meeting Rooms Index [P - Z]':
            return (<MeetingRooms style={props.style.lists} meetingrooms={props.category}/>);
            break;
    }
}