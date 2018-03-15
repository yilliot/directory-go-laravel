import React, { Component } from 'react';
import ReactDOM from 'react-dom';

export default class App extends Component {

    constructor(props) {
        super(props);
    }


    render() {
        return (
            <div id="container">
               Drawing
            </div>
        );
    }
}

window.onload = function() {

    if (document.getElementById('root')) {
        ReactDOM.render(<App />, document.getElementById('root'));
    }

}
