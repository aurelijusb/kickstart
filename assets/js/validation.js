const axios = require('axios');

let name = document.getElementById('name');
let team = document.getElementById('team');

let nameValidation= document.getElementById('validation-name');
let teamValidation = document.getElementById('validation-team');

const validate = (type, validation) => {
    validation.innerText = '...';
    axios.post(validation.dataset.path, {input: type.value})
        .then(function(response) {
            if (response.data.valid) {
                validation.innerHTML = ":)";
            } else {
                validation.innerHTML = ":(";
            }
        })
        .catch(function (error) {
            validation.innerText = 'Error: ' + error;
        });
};

name.onkeyup = () => validate(name, nameValidation);
name.onchange = () => validate(name, nameValidation);

team.onkeyup = () => validate(team, teamValidation);
team.onchange = () => validate(team, teamValidation);
