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
        let category;
        for(let x in blocks) {
            for(let y in blocks[x].levels) {
                let zone_categories = blocks[x].levels[y].zone_categories;
                let area_categories = blocks[x].levels[y].area_categories;
                if(zone_categories) {
                    category = zone_categories[Object.keys(zone_categories)[0]];
                    break;
                }else if(area_categories) {
                    category = area_categories[Object.keys(area_categories)[0]];
                    break;
                }
            }
        }
        this.state = {
            type: 1,
            block: blocks.blocks[0],
            level: blocks.blocks[0].levels[0],
            category: blocks.blocks[0].levels[0].zone_categories[1],
            blocks: blocks.blocks,
            direction: direction,
            index: [
                {name: 'Kampongs Index', ...blocks.kampongIndex},
                {name: 'Facilities Index', ...blocks.facilitiesIndex},
                {name: 'Meeting Rooms Index [A - G]', ...blocks.meetingRoomIndex['A-G']},
                {name: 'Meeting Rooms Index [H - O]', ...blocks.meetingRoomIndex['H-O']},
                {name: 'Meeting Rooms Index [P - Z]', ...blocks.meetingRoomIndex['P-Z']}
            ]
        };
    }

    update(data) {
        this.setState(data);
    }

    activate(block, level, category) {
        // algorithm to find the block, level, and category with the name
        this.setState({block: block, level:level, category: category});
    }

    render() {
        return (
            <div id="container">
                <Buttons 
                    blocks={this.state.blocks}
                    block={this.state.block}
                    index={this.state.index}
                    category={this.state.category}
                    update={this.update}
                />
                <RightBlock
                    type={this.state.type}
                    block={this.state.block}
                    level={this.state.level}
                    index={this.state.index}
                    category={this.state.category}
                    style={Style['rightblock']}
                    update={this.update}
                />
                <Subheading
                    text={this.state.category.name}
                />
                <Heading
                    type={this.state.type}
                    level={this.state.level}
                    block={this.state.block}
                />
                <Display
                    type={this.state.type}
                    style={Style['display']}
                    level={this.state.level}
                    category={this.state.category}
                    direction={this.state.direction}
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

}
