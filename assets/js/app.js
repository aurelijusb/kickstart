require('bootstrap');
const axios = require('axios');

if (typeof needVersion !== "undefined") {
    let versionElement = document.getElementById('version');
    axios.get('/build/version.json')
        .then(function(response) {
            versionElement.innerText = response.data.date;
        })
        .catch(function (error) {
            versionElement.innerText = 'Error: ' . error;
        });
}