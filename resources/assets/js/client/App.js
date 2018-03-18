import React, { Component } from 'react';
import ReactDOM from 'react-dom';

// Css
import './App.css';

// Components
import Block from './Block';
import Index from './Index';

// import { block_data } from './block_data';
let block_data = blocks;

export default class App extends Component {

    constructor(props) {
        super(props);
        this.isActive = this.isActive.bind(this);
        this.activate = this.activate.bind(this);
        this.activateBlock = this.activateBlock.bind(this);
        this.activateFloor = this.activateFloor.bind(this);
        this.state = {
            active: 'block',
            block_data: block_data,
            active_block: block_data[0],
            active_floor: block_data[0].levels[0]
        }
    }

    activate(value) {
        this.setState({active: value});
    }

    isActive(value) {
        return this.state.active === value ? 1 : 0;
    }

    activateBlock(block) {
        this.setState({active_block: block, active_floor: block.levels[0]});
        this.activate('block');
    }

    activateFloor(floor) {
        this.setState({active_floor: floor});
    }

    render() {
        return (
            <div className="container">
                <Index
                    isActive={this.isActive}
                    activate={this.activate}
                />
                <Block
                    active_block={this.state.active_block}
                    activateBlock={this.activateBlock}
                    active_floor={this.state.active_floor}
                    activateFloor={this.activateFloor}
                    block_data={this.state.block_data}
                    isActive={this.isActive}
                    activate={this.activate}
                />
            </div>
        );
    }
}

window.onload = function() {

    if (document.getElementById('root')) {
    ReactDOM.render(<App />, document.getElementById('root'));
    }

};