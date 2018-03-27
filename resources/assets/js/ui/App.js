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
        this.activate = this.activate.bind(this);
        this.directorySetup = this.directorySetup.bind(this);
        this.auto_updater = this.auto_updater.bind(this);
        this.inactivity_timer = this.inactivity_timer.bind(this);
        this.reset_timer = this.reset_timer.bind(this);
        this.lets_go = this.lets_go.bind(this);
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
            ],
            directory: [],
            pointer: pointer,
            timer: null,
        };
    }

    update(data) {
        this.setState(data);
    }

    componentDidMount() {
        let directory = this.directorySetup();
        this.setState({directory: directory});        
        setInterval(this.auto_updater, 30 * 60 * 1000);
        this.lets_go();
        this.inactivity_timer();
    }

    lets_go() {
        // action of redirect
        for(let i in this.state.blocks) {
            let levels = this.state.blocks[i].levels;
            for(let j in levels) {
                if(this.state.pointer.level_id == levels[j].id){
                    // redirect to first category
                    let category = levels[j].zone_categories
                    ? levels[j].zone_categories[Object.keys(levels[j].zone_categories)[0]]
                    ? levels[j].zone_categories[Object.keys(levels[j].zone_categories)[0]]
                    : levels[j].area_categories[Object.keys(levels[j].area_categories)[0]]
                    : levels[j].area_categories[Object.keys(levels[j].area_categories)[0]];
                    this.setState({type: 1, block: this.state.blocks[i], level: levels[j], category: category});
                    break;
                }
            }
        }
    }
    inactivity_timer() {
        this.setState({timer: setInterval(this.lets_go, 2 * 60 * 1000)});
    }

    reset_timer() {
        clearInterval(this.state.timer);
        this.inactivity_timer();
    }

    directorySetup() {
        let directory = new Object;
        for(let i in this.state.blocks) {
            let block = this.state.blocks[i];
            directory[block.name] = block;
            for(let j in block.levels) {
                let level = block.levels[j];
                directory[block.name + '' + level.name] = level;
                for(let k in level.zone_categories) {
                    let category = level.zone_categories[k];
                    directory[block.name + '' + level.name + category.name] = category;
                }
                for(let k in level.area_categories) {
                    let category = level.area_categories[k];
                    directory[block.name + '' + level.name + category.name] = category;
                }
                
            }
        }
        return directory;
    }

    auto_updater() {
        fetch('/publish/version')
        .then(res => res.json())
        .then((result) => {
            console.log('local version: ' + version + ',remote version: ' + result.version);
            if(result.version > version) {
                console.log('There is a lastest version, will refresh in 3 seconds');
                setTimeout(function(){
                    location.reload();
                }, 3000);
                // console.log('There is a latest version, update will be update now!');
                // fetch('/publish/data').then(res => res.json()).then((result) => {
                //     let blocks = JSON.parse(result);
                // });
                // this.setState({
                //     blocks: blocks.blocks,
                //     index: [
                //         {name: 'Kampongs Index', ...blocks.kampongIndex},
                //         {name: 'Facilities Index', ...blocks.facilitiesIndex},
                //         {name: 'Meeting Rooms Index [A - G]', ...blocks.meetingRoomIndex['A-G']},
                //         {name: 'Meeting Rooms Index [H - O]', ...blocks.meetingRoomIndex['H-O']},
                //         {name: 'Meeting Rooms Index [P - Z]', ...blocks.meetingRoomIndex['P-Z']}
                //     ],
                // });
                // this.setState({directory: this.directorySetup()});
                // console.log('updated');
                
            } else console.log('There is currently no newer version.');
        });
    }

    activate(block, level, category) {
        // algorithm to find the block, level, and category with the name
        let b, l, c;
        b = this.state.directory[block];
        l = this.state.directory[block+''+level];
        c = this.state.directory[block+''+level+category];
        this.setState({type: 1, block: b, level:l, category: c});
    }

    render() {
        return (
            <div onClick={this.reset_timer} id="container">
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
                    blocks={this.state.blocks}
                    category={this.state.category}
                    direction={this.state.direction}
                    activate={this.activate}
                    pointer={this.state.pointer}
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
