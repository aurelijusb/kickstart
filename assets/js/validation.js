const axios = require('axios');

let name = document.getElementById('name');
let validationResult = document.getElementById('validation-result');

let project = document.getElementById('project');
let projectValidationResult = document.getElementById('project-validation-result');

const validateName = function () {
    validationResult.innerText = '...';
    axios.post(validationResult.dataset.path, {input: name.value})
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

const validateProject = function () {
    projectValidationResult.innerText = '...';
    axios.post(projectValidationResult.dataset.path, {input: project.value})
        .then(function(response) {
            if (response.data.valid) {
                projectValidationResult.innerHTML = ":)";
            } else {
                projectValidationResult.innerHTML = ":(";
            }
        })
        .catch(function (error) {
            projectValidationResult.innerText = 'Error: ' + error;
        });
};

name.onkeyup = validateName;
name.onchange = validateName;
project.onkeyup = validateProject;
project.onchange = validateProject;
