import React, { Component } from 'react';
import ReactDOM from 'react-dom';

export default function Display(props) {
    return (
        <div style={props.style.style}>
            <Map
                src={props.level.map_path}
            />

        </div>
    );
}

function Map(props) {
    return (
        <img style={{width: '90%'}} src={'/storage/' + props.src} />
    );
}

function Overlays(props) {

}