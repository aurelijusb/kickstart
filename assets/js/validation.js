const axios = require('axios');

let name = document.getElementById('name');
let validationResultName = document.getElementById('validation-result-name');
let team = document.getElementById('team');
let validationResultTeam = document.getElementById('validation-result-team');

const validateName = function () {
    validationResultName.innerText = '...';
    axios.post(validationResultName.dataset.path, {input: name.value})
        .then(function (response) {
            if (response.data.valid) {
                validationResultName.innerHTML = "<img src=https://reactiongifs.me/wp-content/uploads/2019/02/Macho-Man-Smile.gif width=\"200px\" height=\"150px\" alt=\"alt\">";
            } else {
                validationResultName.innerHTML = "<img src=https://media1.giphy.com/media/nstGUYA6WnWJa/giphy.gif?cid=790b7611e958e0e51adbfce26cccda017a20761d1ac59c6d&rid=giphy.gif width=\"200px\" height=\"150px\" alt=\"alt\">";
            }
        })
        .catch(function (error) {
            validationResultName.innerText = 'Error: ' + error;
        });
};

const validateTeam = function () {
    validationResultTeam.innerText = '...';
    axios.post(validationResultTeam.dataset.path, {input: team.value})
        .then(function (response) {
            if (response.data.valid) {
                validationResultTeam.innerHTML = "<img src=https://media.giphy.com/media/cJMmZY7jSCtwN4z0WX/giphy.gif width=\"200px\" height=\"150px\" alt=\"alt\">";
            } else {
                validationResultTeam.innerHTML = "<img src=https://media.giphy.com/media/3o6Zt7j5rtQUNPiw8g/giphy.gif width=\"200px\" height=\"150px\" alt=\"alt\">";
            }
        })
        .catch(function (error) {
            validationResultTeam.innerText = 'Error: ' + error;
        });
};

name.onkeyup = validateName;
name.onchange = validateName;
team.onkeyup = validateTeam;
team.onchange = validateTeam;
