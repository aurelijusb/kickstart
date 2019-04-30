const axios = require('axios');

let name = document.getElementById('name');
let validationResult = document.getElementById('validation-result');
const validateName = function () {
    validationResult.innerText = '...';
    axios.post(validationResult.dataset.path, {input: name.value})
        .then(function (response) {
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

document.getElementById('komanda').addEventListener("click", komanda(), true);

function komanda() {
    let komanda = document.getElementById('komanda');
    let validationResultTwo = document.getElementById('validation-result-two');

    const validateTeam = function () {
        validationResultTwo.innerText = "...";
        axios.post(validationResultTwo.dataset.path, {input: name.value})
            .then(function (resposnse) {
                if (resposnse.data.valid) {
                    validationResultTwo.innerText = ":)";
                } else {
                    validationResultTwo.innerText = ":(";
                }
            })
            .catch(function (error) {
                validationResultTwo.innerText = "Error:" + error;
            })
    }

    name.onkeyup = validateTeam;
    name.onchange = validateTeam;
}