const axios = require('axios');

let team = document.getElementById('team');
let validationResult = document.getElementById('validation-result-team');
const validateTeam = function () {
    validationResult.innerText = '...';
    axios.post(validationResult.dataset.path, {input: team.value})
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

team.onkeyup = validateTeam;
team.onchange = validateTeam;