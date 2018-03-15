import React, { Component } from 'react';
import ReactDOM from 'react-dom';

import './App.css';

import Style from './StyleConfiguration';

import Buttons from './Buttons';
import RightBlock from './RightBlock';
import Display from './Display';
import Heading from './Heading';
import Subheading from './Subheading';

export default class App extends Component {

    constructor(props) {
        super(props);
        // this.myfunction = this.myfunction.bind(this);
        this.update = this.update.bind(this);
        this.state = {
            type: 1,
            block: blocks[0],
            level: blocks[0].levels[0],
            category: blocks[0].levels[0],//.category[0],
            blocks: blocks
        };
    }

    update(data) {
        this.setState(data);
    }

    render() {
        return (
            <div id="container">
                <Buttons 
                    blocks={this.state.blocks}
                    block={this.state.block}
                    style={Style['buttons']}
                    update={this.update}
                />
                <RightBlock
                    type={this.state.type}
                    block={this.state.block}
                    level={this.state.level}
                    category={this.state.category}
                    style={Style['rightblock']}
                    update={this.update}
                />
                <Subheading
                    text={this.state.category.name}
                    style={Style['subheading']}
                />
                <Heading
                    type={this.state.type}
                    style={Style['heading']}
                    level={this.state.level}
                    block={this.state.block}
                />
                <Display
                    style={Style['display']}
                    level={this.state.level}
                    category={this.state.categry}
                />
            </div>
        );
    }
}

window.onload = function() {

    if (document.getElementById('root')) {
        ReactDOM.render(<App />, document.getElementById('root'));
    }

}
