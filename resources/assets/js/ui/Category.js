import React, { Component } from 'react';
import ReactDOM from 'react-dom';

import './Category.css';

export default class Category extends Component {
    render() {
        return (
            <div id="category">
                <div className="button" style={{'backgroundColor': this.props.color}}>
                    CategoryButton
                </div>
            </div>
        );
    }
}
