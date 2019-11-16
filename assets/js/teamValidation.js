const axios = require('axios');

let team = document.getElementById('team');
let validationResultTeam = document.getElementById('validation-result-team');
const validateTeam = function () {
    validationResultTeam.innerText = '...';
    axios.post(validationResultTeam.dataset.path, {input: team.value})
        .then(function(response) {
            if (response.data.valid) {
                validationResultTeam.innerHTML = ":)";
            } else {
                validationResultTeam.innerHTML = ":(";
            }
        })
        .catch(function (error) {
            validationResultTeam.innerText = 'Error: ' + error;
        });
};

team.onkeyup = validateTeam;
team.onchange = validateTeam;
