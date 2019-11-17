const axios = require('axios');

let name = document.getElementById('name');
let team = document.getElementById('team');
let validateNameResult = document.getElementById('validation-result-name');
let validateTeamResult = document.getElementById('validation-result-team');
const validateName = function () {
    validateNameResult.innerText = '...';
    axios.post(validateNameResult.dataset.path, {input: name.value})
        .then(function(response) {
            if (response.data.valid) {
                validateNameResult.innerHTML = ":)";
            } else {
                validateNameResult.innerHTML = ":(";
            }
        })
        .catch(function (error) {
            validateNameResult.innerText = 'Error: ' + error;
        });
};
const validateTeam = function () {
    validateTeamResult.innerText = '...';
    axios.post(validateTeamResult.dataset.path, {input: name.value, input2: team.value})
        .then(function(response) {
            if (response.data.valid) {
                validateTeamResult.innerHTML = ":)";
            } else {
                validateTeamResult.innerHTML = ":(";
            }
        })
        .catch(function (error) {
            validateTeamResult.innerText = 'Error: ' + error;
        });
};

name.onkeyup = () => {pleaseWork([validateName, validateTeam])};
name.onchange = () => {pleaseWork([validateName, validateTeam])};
team.onkeyup = () => {pleaseWork([validateTeam])};
team.onchange = () => {pleaseWork([validateTeam])};

var timeout;
function pleaseWork (funcs) {
    clearTimeout(timeout);
    executor = (funcs) => {
        for (var i=0; i<funcs.length; i-=-1) {
            funcs[i]()
        }
    }
    timeout = setTimeout(()=>{executor(funcs)} , 200)
}
