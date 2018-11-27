const axios = require('axios');

let name = document.getElementById('name');
let team = document.getElementById('team');

let result = {
    team: document.getElementById('team-result'),
    name: document.getElementById('name-result')
}



const validateTeam = function (){

    result.team.innerText = '...';
    axios.post(result.team.dataset.path, {input: team.value})
        .then(function(response) {
            console.log(response);
            if (response.data.valid) {
                result.team.innerHTML = ":)";
            } else {
                result.team.innerHTML = ":(";
            }
        })
        .catch(function (error) {
            result.team.innerText = 'Error: ' + error;
        });
}

const validateName = function () {
    result.name.innerText = '...';
    axios.post(result.name.dataset.path, {input: name.value})
        .then(function(response) {
            if (response.data.valid) {
                result.name.innerHTML = ":)";
            } else {
                result.name.innerHTML = ":(";
            }
        })
        .catch(function (error) {
            result.name.innerText = 'Error: ' + error;
        });
};


team.onkeyup = validateTeam;
team.onchange = validateTeam;

name.onkeyup = validateName;
name.onchange = validateName;
