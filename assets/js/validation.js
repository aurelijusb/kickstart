const axios = require('axios');

let name = document.getElementById('name');
let team = document.getElementById('team');
let validationName = document.getElementById('validation-name-result');
let validationTeam = document.getElementById('validation-team-result');

const validate = (validationType, validationResult) => {
    validationResult.innerText = '...';
    axios.post(validationResult.dataset.path, {input: validationType.value})
        .then(function (response) {
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

name.onkeyup = () => validate(name, validationName);
name.onchange = () => validate(name, validationName);


team.onkeyup = () => validate(team, validationTeam);
team.onchange = () => validate(team, validationTeam);