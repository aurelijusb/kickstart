import axios from 'axios';

let name = document.getElementById('name');
let validationResultName = document.getElementById('validation-result-name');

let team = document.getElementById('team');
let validationResultTeam = document.getElementById('validation-result-team');

const validateName = () => {
    validationResultName.innerText = '...';

    axios.post(validationResultName.dataset.path, {
        input: name.value,
    }).then(response => {
        if (response.data.valid) {
            validationResultName.innerText = ':)';
        } else {
            validationResultName.innerText = ':(';
        }
    }).catch(error => {
        validationResultName.innerText = 'Error: ' + error;
    })
};

const validateTeam = () => {
    validationResultTeam.innerText = '...';

    axios.post(validationResultTeam.dataset.path, {
        input: team.value,
    }).then(response => {
        if (response.data.valid) {
            validationResultTeam.innerText = ':)';
        } else {
            validationResultTeam.innerText = ':(';
        }
    }).catch(error => {
        validationResultTeam.innerText = 'Error: ' + error;
    })
};

name.onkeyup = validateName;
name.onchange = validateName;

team.onkeyup = validateTeam;
team.onchange = validateTeam;