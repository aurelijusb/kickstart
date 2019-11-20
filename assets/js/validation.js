const axios = require('axios');

let name = document.getElementById('name');
let validationResultName = document.getElementById('validation-result-name');
let team = document.getElementById('team')
let validationResultTeam = document.getElementById('validation-result-team');

const validate = (type, value) => {
    type.innerText = '...';
    axios.post(type.dataset.path, {input: value.value})
        .then(function(response) {
            if (response.data.valid) {
                type.innerHTML = ":)";
            } else {
                type.innerHTML = ":(";
            }
        })
        .catch(function (error) {
            type.innerText = 'Error: ' + error;
        });
};


name.onkeyup = () => validate(validationResultName, name);
name.onchange = () => validate(validationResultName, name);

team.onkeyup = () => validate(validationResultTeam, team);
team.onchange = () => validate(validationResultTeam, team);