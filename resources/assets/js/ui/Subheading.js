import React, { Component } from 'react';
import ReactDOM from 'react-dom';

export default function Subheading(props) {
    return (
        <div id='sub-heading' className='text-grey'>
            {props.text}
        </div>
    );
}