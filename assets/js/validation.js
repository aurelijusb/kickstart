window.addEventListener("load",() => {
    const axios = require('axios');

    let name = document.getElementById('name');
    let validationResultStudent = document.getElementById('validation-result-name');
    let team = document.getElementById('team');
    let validationResultTeam = document.getElementById('validation-result-team');

    if (!(name && validationResultStudent && team && validationResultTeam)) {
        console.log("Didn't find HTML elements :(");
    } else {
        const validate = function (validationResult, input) {
            validationResult.innerText = '...';
            axios.post(validationResult.dataset.path, {input: input.value})
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
        name.onkeyup = ()=>validate(validationResultStudent, name);
        name.onchange = ()=>validate(validationResultStudent, name);
        team.onkeyup = ()=>validate(validationResultTeam, team);
        team.onchange = ()=>validate(validationResultTeam, team);
    }
})