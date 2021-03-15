import React from 'react';
import ReactDOM from 'react-dom';

const e = React.createElement;

class HelloWorld extends React.Component {
    render() {
        return 'Hello from React!';
    }
}

const domContainer = document.querySelector('#react-test');
ReactDOM.render(e(HelloWorld), domContainer);