const axios = require('axios');

const name = document.getElementById('name');
const nameValidation = document.getElementById('validation-result-name');

const team = document.getElementById('team');
const teamValidation = document.getElementById('validation-result-team');

const validate = (input, validationText) => {
    validationText.innerText = '...';
    axios
        .post(validationText.dataset.path, { input: input.value })
        .then(response => {
            response.data.valid
            ? (validationText.innerHTML = ':)')
            : (validationText.innerHTML = ':(');
        })
        .catch(error => {
            validationText.innerText = 'Error ' + error;
        });
};

const eventListeners = (input, validationText) => {
    const events = ['keyup', 'change'];
    events.forEach(
        event =>
        input.addEventListener(event, () => validate(input, validationText))
    );
};

eventListeners(name, nameValidation);
eventListeners(team, teamValidation);
