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

name.onkeyup = validateName;
name.onchange = validateName;

let command = document.getElementById('command');
let validationCommandResult = document.getElementById('validation-command-result');
const validateCommandName = function () {
    validationCommandResult.innerText = '...';
    axios.post(validationCommandResult.dataset.path, {input: command.value})
        .then(function(response) {
            if (response.data.valid) {
                validationCommandResult.innerHTML = ":)";
            } else {
                validationCommandResult.innerHTML = ":(";
            }
        })
        .catch(function (error) {
            validationCommandResult.innerText = 'Error: ' + error;
        });
};

command.onkeyup = validateCommandName;
command.onchange = validateCommandName;