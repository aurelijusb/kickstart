const axios = require('axios');

let name = document.getElementById('name');
let team = document.getElementById('team');
let validationResultName = document.getElementById('validation-result-name');
let validationResultTeam = document.getElementById('validation-result-team');
const validate = function (validationResult) {
    validationResult.innerText = '...';
    axios.post(validationResult.dataset.path, {
        name: name.value,
        team: team.value
    })
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

name.onkeyup = () => validate(validationResultName);
name.onchange = () => validate(validationResultName);
team.onkeyup = () => validate(validationResultTeam);
team.onchange = () => validate(validationResultTeam);