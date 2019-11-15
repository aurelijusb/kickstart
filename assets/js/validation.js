const axios = require('axios');

// input name
let inputName = document.getElementById('name');
let validationResultName = document.getElementById('validation-result-name');
const validateName = function () {
    validationResultName.innerText = '...';
    axios.post(validationResultName.dataset.path, {input: inputName.value})
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

inputName.onkeyup = validateName;
inputName.onchange = validateName;

// input team
let inputTeam = document.getElementById('team');
let validationResultTeam = document.getElementById('validation-result-team');
const validateTeam = function () {
    validationResultTeam.innerText = '...';
    axios.post(validationResultTeam.dataset.path, {input: inputTeam.value})
        .then(function (response) {
            if (response.data.valid) {
                validationResultTeam.innerHTML = ":)";
            } else {
                validationResultTeam.innerHTML = ":(";
            }
        })
        .catch(function (error) {
            validationResultTeam.innerText = 'Error: ' + error;
        });
};

inputTeam.onkeyup = validateTeam;
inputTeam.onchange = validateTeam;

