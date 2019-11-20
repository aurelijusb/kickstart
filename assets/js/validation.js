const axios = require('axios');

let name = document.getElementById('name');
let validationResult = document.getElementById('validation-result-name');
const validateName = function () {
    validationResult.innerText = '...';
    axios.post(validationResult.dataset.path, {input: name.value})
        .then(function(response) {
            if (response.data.valid) {
                validationResult.innerHTML = ":)";
            } else {
                validationResult.innerHTML = ":(";
            }
        })
        .catch(function (error) {
            validationResult.innerText = 'Error: ' + error;
        });
};

name.onkeyup = validateName;
name.onchange = validateName;

let team = document.getElementById('team');
let teamvalidationResult = document.getElementById('validation-result-team');
const validateTeam = function () {
    teamvalidationResult.innerText = '...';
    axios.post(teamvalidationResult.dataset.path, {input: team.value})
        .then(function(response) {
            if (response.data.valid) {
                teamvalidationResult.innerHTML = ":)";
            } else {
                teamvalidationResult.innerHTML = ":(";
            }
        })
        .catch(function (error) {
            teamvalidationResult.innerText = 'Error: ' + error;
        });
};

team.onkeyup = validateTeam;
team.onchange = validateTeam;