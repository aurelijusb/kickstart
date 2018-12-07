const axios = require('axios');

let name = document.getElementById('name');
let team = document.getElementById('team');
let validationResultName = document.getElementById('validation-result-name');
let validationResultTeam = document.getElementById('validation-result-team');
const validate = function (validationResult, payload) {
    console.log(validationResult);
    console.log(payload);
    validationResult.innerText = '...';
    axios.post(validationResult.dataset.path, payload)
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

name.onkeyup = () => validate(validationResultName, {name: name.value });
name.onchange = () => validate(validationResultName, {name: name.value });
team.onkeyup = () => validate(validationResultTeam, {team: team.value });
team.onchange = () => validate(validationResultTeam, {team: team.value });