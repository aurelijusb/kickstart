const axios = require('axios');

let name = document.getElementById('name');
let project = document.getElementById('project');

let nameValidationResult = document.getElementById('name-validation-result');
let projectValidationResult = document.getElementById('project-validation-result');

const validate = (inputName, validationResult) =>  {
    validationResult.innerText = '...';
    return () => {
        axios.post(validationResult.dataset.path, {input: inputName.value})
            .then(function(response){
                if(response.data.valid){
                    validationResult.innerText = ":)";
                }  else{
                    validationResult.innerText = ":(";
                }
            })
            .catch(function(error){
                validationResult.innerText = "Error: " + error;
            });
    };
};

name.onkeyup = validate(name, nameValidationResult);
name.onchange = validate(name, nameValidationResult);

project.onkeyup = validate(project, projectValidationResult);
project.onchange = validate(project, projectValidationResult);
