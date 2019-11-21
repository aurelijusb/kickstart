const axios = require('axios');

let name = document.getElementById('name');
let validationResult = document.getElementById('validation-result-name');

let team = document.getElementById('team');
let validationResultTeam = document.getElementById('validation-result-team');


function validateInput(input, resultElement)
{
    resultElement.innerText = '...';
    axios.post(resultElement.dataset.path, {input: input.value})
        .then(function (response) {
            if (response.data.valid) {
                resultElement.innerHTML = ":)";
            } else {
                resultElement.innerHTML = ":(";
            }
        })
        .catch(function (error) {
            resultElement.innerText = 'Error: ' + error;
        });
}

name.onkeyup = function () {
    validateInput(this, validationResult)
};
name.onchange = function () {
    validateInput(this, validationResult)
};

team.onkeyup = function () {
    validateInput(this, validationResultTeam)
};
team.onchange = function () {
    validateInput(this, validationResultTeam)
};
