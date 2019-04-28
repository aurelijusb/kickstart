const axios = require('axios');

let nameInput = document.querySelector('#name');
let projectInput = document.querySelector('#project');
let nameSpan = document.querySelector('#name-result');
let projectSpan = document.querySelector('#project-result');


const validateName = function(){
    nameSpan.innerText='...';
    axios.post(nameSpan.dataset.path, {input: nameInput.value})
        .then(response => {
            if (response.data.valid) {
                nameSpan.innerHTML = ":)";
            } else {
                nameSpan.innerHTML = ":(";
            }
        })
        .catch(error => console.log(error))
};

const validateProject = function(){
    projectSpan.innerText='...';
    axios.post(projectSpan.dataset.path, {input: projectInput.value})
        .then(response => {
            if (response.data.valid) {
                projectSpan.innerHTML = ":)";
            } else {
                projectSpan.innerHTML = ":(";
            }
        })
        .catch(error => console.log(error))
};

nameInput.onkeyup = validateName;
projectInput.onkeyup = validateProject;
