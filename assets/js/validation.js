const axios = require('axios');

let name = document.getElementById('name');
let team = document.getElementById('team');
let validationResultName = document.getElementById('validation-result-name');
let validationResultTeam = document.getElementById('validation-result-team');

const validate = (elementResult, inputResult) => () => {
    elementResult.innerText = '...';
    axios.post(elementResult.dataset.path, {input: inputResult.value})
        .then(function(response) {
            if (response.data.valid) {
                elementResult.innerHTML = ":)";
            } else {
                elementResult.innerHTML = ":(";
            }
        })
        .catch(function (error) {
            elementResult.innerText = 'Error: ' + error;
        });
};

name.onkeyup = validate(validationResultName, name);
name.onchange = validate(validationResultName, name);
team.onkeyup = validate(validationResultTeam, team);
team.onchange = validate(validationResultTeam, team);
