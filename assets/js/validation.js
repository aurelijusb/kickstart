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

let team = document.getElementById('team');
let validationResult2 = document.getElementById('validation-result-team');
const validateName2 = function () {
    validationResult2.innerText = 'Įrašėteeeee: ' + team.value;
};

team.onkeyup = validateName2;
team.onchange = validateName2;

