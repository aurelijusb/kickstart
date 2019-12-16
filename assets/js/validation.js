const axios = require('axios');

let name = document.getElementById('name');
let team = document.getElementById('team');
let validationResult1 = document.getElementById('validation-result-1');
let validationResult2 = document.getElementById('validation-result-2');

name.onkeyup = function(){
    validationResult1.innerText = '...';
    axios.post(validationResult1.dataset.path, {input: name.value})
        .then(function(response) {
            if (response.data.valid) {
                validationResult1.innerHTML = ":)";
            } else {
                validationResult1.innerHTML = ":(";
            }
        })
        .catch(function (error) {
            validationResult1.innerText = 'Error: ' + error;
        });
};
name.onchange = name.onkeyup;

team.onkeyup = function(){
    validationResult2.innerText = '...';
    axios.post(validationResult2.dataset.path, {input: team.value})
        .then(function(response) {
            if (response.data.valid) {
                validationResult2.innerHTML = ":)";
            } else {
                validationResult2.innerHTML = ":(";
            }
        })
        .catch(function (error) {
            validationResult2.innerText = 'Error: ' + error;
        });
};
team.onchange = team.onkeyup;