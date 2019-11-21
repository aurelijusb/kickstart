const axios = require('axios');

const name = document.getElementById('name');
const team = document.getElementById('team');

const validate = (input, field) => {
    const validation = document.getElementById(`validation-result-${field}`)
    axios.post(validation.dataset.path, {input: input.value})
        .then(response => {
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

name.onkeyup = () => validate(name, 'name');
name.onchange = () => validate(name, 'name');

team.onkeyup = () => validate(team, 'team');
team.onchange = () => validate(team, 'team');

