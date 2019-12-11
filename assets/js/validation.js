const axios = require('axios');

let name = document.getElementById('name');
let nameValidationResult = document.getElementById('validation-result-name');
const validateName = function () {
    nameValidationResult.innerText = '...';
    axios.post(nameValidationResult.dataset.path, {input: name.value})
        .then(function (response) {
            if (response.data.valid) {
                nameValidationResult.innerHTML = ":)";
            } else {
                nameValidationResult.innerHTML = ":(";
            }
        })
        .catch(function (error) {
            nameValidationResult.innerText = 'Error: ' + error;
        });
};


name.onkeyup = validateName;
name.onchange = validateName;


let team = document.getElementById('team');
let teamValidationResult = document.getElementById('validation-result-team');
const validateTeam = function () {
    teamValidationResult.innerText = '...';
    axios.post(teamValidationResult.dataset.path, {input: team.value})
        .then(function (response) {
            if (response.data.valid) {
                teamValidationResult.innerHTML = ":)";
            } else {
                teamValidationResult.innerHTML = ":(";
            }
        })
        .catch(function (error) {
            teamValidationResult.innerText = 'Error: ' + error;
        });
};




team.onkeyup = validateTeam;
team.onchange = validateTeam;
