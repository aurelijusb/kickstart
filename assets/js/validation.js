const axios = require('axios');

const name = document.getElementById('name');
const project = document.getElementById('project');

const validate = (input, field) => {
    const validation = document.getElementById(`validation-${field}`)
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

project.onkeyup = () => validate(project, 'project');
project.onchange = () => validate(project, 'project');

