import React, { Component } from 'react';
import ReactDOM from 'react-dom';

export default function Subheading(props) {
    return (
        <div style={props.style.style}>
            {props.text}
        </div>
    );
}