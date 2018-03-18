import React, { Component } from 'react';
import ReactDOM from 'react-dom';

import './Block.css';

import Floor from './Floor'; 

export default class Block extends Component {

    constructor(props) {
        super(props);
        this.isActive = this.isActive.bind(this);
        this.activateBlock = this.activateBlock.bind(this);
    }

    activateBlock(block) {
        this.props.activateBlock(block);
    }

    isActive(value) {
        return this.props.active_block.name === value && this.props.isActive('block') ? 'active' : '';
    }

    render() {
        let block_button = [];
        this.props.block_data.forEach((value, i) => {
            block_button.push(
                <BlockButton
                    isActive={this.isActive} 
                    activateBlock={this.activateBlock} 
                    block={value} 
                    key={i}
                />);
        });

        let display = this.props.isActive('block')?
            (
                <div>
                    <BlockDisplay block={this.props.active_block}/>
                    <Floor
                        block={this.props.active_block}
                        active_floor={this.props.active_floor}
                        activateFloor={this.props.activateFloor}
                    />
                </div>
            ): <div/>;
        return (
            <div id="block">
                <div className="button">
                    {block_button}
                </div>
                {display}
            </div>
        );
    }
}

function BlockButton(props) {
    return (
        <button 
            className={props.isActive(props.block.name)} 
            onClick={props.activateBlock.bind(this, props.block)} 
            style={{"backgroundColor": props.block.colour}}
        >
            {props.block.name}
        </button>
    );
}

function BlockDisplay(props) {
    return (
        <div className="display" style={{"backgroundColor": props.block.colour}}>
            {props.block.name}
        </div>
    );
}