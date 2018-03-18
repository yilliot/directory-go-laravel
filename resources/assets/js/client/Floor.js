import React, { Component } from 'react';
import ReactDOM from 'react-dom';

import './Floor.css';

import Category from './Category';

export default class Floor extends Component {

    constructor(props) {
        super(props);
        this.isActive = this.isActive.bind(this);
    }

    isActive(floor) {
        return this.props.active_floor === floor ? 1: 0;
    }

    render() {
        const block = this.props.block;
        let floor_button = [];

        block.levels.forEach((value, i) => {

            floor_button.push(
                <FloorButton
                    floor={value}
                    key={i}
                    activateFloor={this.props.activateFloor.bind(this, value)}
                    isActive={this.isActive}
                    color={block.colour}
                />);
        });

        return (
            <div id="floor">
                <div className="button">
                    {floor_button}
                </div>
                <FloorDisplay name={this.props.active_floor.name}/>
                <Category color={this.props.block.colour}/>
            </div>
        );
    }
}

function FloorButton(props) {
    let color = props.isActive(props.floor) ? props.color : '#e2e2e2';
    return (
        <div
            className="floor"
            style={{"backgroundColor": color}}
            onClick={props.activateFloor}
        >
            {props.floor.name}
        </div>
    );
}

function FloorDisplay(props) {
    return (
        <div className="display">
            {props.name}
        </div>
    );
}