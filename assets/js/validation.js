const axios = require('axios');

let name = document.getElementById('name');
let validationResultName = document.getElementById('validation-result-name');
const validateName = function () {
    validationResultName.innerText = '...';
    axios.post(validationResultName.dataset.path, {input: name.value})
        .then(function (response) {
            if (response.data.valid) {
                validationResultName.innerHTML = ":)";
            } else {
                validationResultName.innerHTML = ":(";
            }
        })
        .catch(function (error) {
            validationResultName.innerText = 'Error: ' + error;
        });
};

let team = document.getElementById('team');
let validateResultTeam = document.getElementById('validation-result-team');
const validateTeam = function () {
    validateResultTeam.innerText = '...';
    axios.post(validateResultTeam.dataset.path, { input: team.value})
        .then(function (response) {
            if (response.data.valid) {
                validateResultTeam.innerHTML = ":)";
            } else {
                validateResultTeam.innerHTML = ":(";
            }
        })
        .catch(function (error) {
            validateResultTeam.innerText = 'Error: ' + error;
        });
};

name.onkeyup = validateName;
name.onchange = validateName;
team.onkeyup = validateTeam;
team.onchange = validateTeam;








