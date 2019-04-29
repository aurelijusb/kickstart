const axios = require('axios');

let name = document.getElementById('name');
let team = document.getElementById('team');
let validationResult = document.getElementById('validation-result');
let validationTeamResult = document.getElementById('validation-team-result');

const validateName = function () {
    validate(validationResult, name.value);
};

const validateTeam = function () {
    validate(validationTeamResult, team.value);
};

function validate(result, type) {
    result.innerText = '...';
    axios.post(result.dataset.path, {input: type})
        .then(function(response){
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

name.onkeyup = validateName;
name.onchange = validateName;

team.onkeyup = validateTeam;
team.onchange = validateTeam;
