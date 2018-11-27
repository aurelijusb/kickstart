const axios = require('axios');

let name = document.getElementById('name');
let validationResult = document.getElementById('validation-result');
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

let team = document.getElementById('team');
let validationTeamResult = document.getElementById('validation-team-result');
const validateTeam = function () {
    validationTeamResult.innerText = '...';
    axios.post(validationTeamResult.dataset.path, {team: team.value})
        .then(function(response) {
            if (response.data.valid) {
                validationTeamResult.innerHTML = ":)";
            } else {
                validationTeamResult.innerHTML = ":(";
            }
        })
        .catch(function (error) {
            validationTeamResult.innerText = 'Error: ' + error;
        });
};

name.onkeyup = validateName;
name.onchange = validateName;
team.onkeyup = validateTeam;
team.onchange = validateTeam;