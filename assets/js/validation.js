const axios = require('axios');

function validate(element) {
    let field = document.getElementById(element);
    let validationResult = document.getElementById(element + '-validation-result');
    const validateElement = function () {
        validationResult.innerText = '...';
        axios.post(validationResult.dataset.path, {input: field.value})
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

    field.onkeyup = validateElement;
    field.onchange = validateElement;
    if (field.value !== '') {
        field.onchange();
    }
}

validate('name');
validate('project');