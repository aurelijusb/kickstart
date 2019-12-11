const axios = require('axios');

let name = document.getElementById('name');
let nameValidationResult = document.getElementById('validation-result-name');

let team = document.getElementById('team');
let teamValidationResult = document.getElementById('validation-result-team');

function validate (input, result) {
    result.innerText = '...';
    axios.post(result.dataset.path, {input: input.value})
        .then(function(response) {
            if (response.data.valid) {
                result.innerHTML = ":)";
            } else {
                result.innerHTML = ":(";
            }
        })
        .catch(function (error) {
            result.innerText = 'Error: ' + error;
        });
}

name.onkeyup = () => validate(name, nameValidationResult);
name.onchange = () => validate(name, nameValidationResult);

team.onkeyup = () => validate(team, teamValidationResult);
team.onchange = () => validate(team, teamValidationResult);

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

name.onkeyup = validateName;
name.onchange = validateName;
