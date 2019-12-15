const axios = require('axios');

const validateType = (validate, type) => {
    validate.innerText = '...';
    axios.post(validate.dataset.path, {input: type.value})
        .then(function(response) {
            if (response.data.valid) {
                validate.innerHTML = ":)";
            } else {
                validate.innerHTML = ":(";
            }
        })
        .catch(function (error) {
            validate.innerText = 'Error: ' + error;
        });
};

let name = document.getElementById('name');
let validateName= document.getElementById('validation-result-name');
name.onkeyup = () => validateType(validateName, name);
name.onchange = () => validateType(validateName, name);


let team = document.getElementById('team');
let validateTeam = document.getElementById('validation-result-team');
team.onkeyup = () => validateType(validateTeam, team);
team.onchange = () => validateType(validateTeam, team);
