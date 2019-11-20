const React = require('react');
const ReactDOM = require('react-dom');

if (typeof usingReactApp !== "undefined") {
    ReactDOM.render(
        <h1>Hello, world!</h1>,
        document.getElementById('root')
        );
}

const axios = require('axios');
if (typeof usingVersionedFileJs !== "undefined") {
    let versionedFileElement = document.getElementById('versionedFile');
    axios.get('/build/manifest.json')
        .then(function (response) {
            versionedFileElement.innerText = response.data['build/app.js'];
        })
        .catch(function (error) {
            versionedFileElement.innerText = 'Error: '.error;
        });
}