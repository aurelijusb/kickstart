const axios = require('axios');

let name = document.getElementById('name');
let validationResult = document.getElementById('validation-result-name');

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

name.onkeyup = validateName;
name.onchange = validateName;




let project = document.getElementById('project');
let validationResultProject = document.getElementById('validation-result-project');

const validateProject = function () {
    validationResultProject.innerText = '...';
    axios.post(validationResultProject.dataset.path, {input: project.value})
        .then(function(response) {
            if (response.data.valid) {
                validationResultProject.innerHTML = ":)";
            } else {
                validationResultProject.innerHTML = ":(";
            }
        })
        .catch(function (error) {
            validationResultProject.innerText = 'Error: ' + error;
        });
};

project.onkeyup = validateProject;
project.onchange = validateProject;
