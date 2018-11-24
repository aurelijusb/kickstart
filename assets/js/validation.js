const axios = require('axios');

let name = document.getElementById('name');
let project = document.getElementById('project');
let nameValidationResult = document.getElementById('name-validation-result');
let projectValidationResult = document.getElementById('project-validation-result');
const validate = function (inputElement, resultElement) {
    resultElement.innerText = '...';
    axios.post(resultElement.dataset.path, {input: inputElement.value})
        .then(function(response) {
            if (response.data.valid) {
                resultElement.innerHTML = ":)";
            } else {
                resultElement.innerHTML = ":(";
            }
        })
        .catch(function (error) {
            resultElement.innerText = 'Error: ' + error;
        });
};

name.onkeyup = () => validate(name, nameValidationResult);
name.onchange = () => validate(name, nameValidationResult);
project.onkeyup = () => validate(project, projectValidationResult);
project.onchange = () => validate(project, projectValidationResult);