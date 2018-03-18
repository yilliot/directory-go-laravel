import React, { Component } from 'react';
import ReactDOM from 'react-dom';

import './Index.css';

import IndexCategory from './IndexCategory'

export default class Index extends Component {

    render() {
        let display = this.props.isActive('index')?
            (
                <div>
                    <div className="display" style={{"backgroundColor": 'grey'}}>
                        Index
                    </div>
                    <IndexCategory />
                </div>
            ): <div/>;
        return (
            <div id="index">
                <div className="button">
                    <button 
                        className={this.props.isActive('index')? 'active': ''} 
                        onClick={this.props.activate.bind(this, 'index')} 
                        style={{"backgroundColor": 'grey'}}
                    >
                        Index
                    </button>
                </div>
                {display}
            </div>
        );
    }

}