const axios = require('axios')

let name = document.getElementById('name')
let team = document.getElementById('team')

const validate = (type, input) => {
  let validationResult = document.getElementById('validation-result-' + type)
  validationResult.innerText = '...'
  axios
    .post(validationResult.dataset.path, { input: input.value })
    .then(function(response) {
      if (response.data.valid) {
        validationResult.innerHTML = ':)'
      } else {
        validationResult.innerHTML = ':('
      }
    })
    .catch(function(error) {
      validationResult.innerText = 'Error: ' + error
    })
}

name.onkeyup = () => validate('name', name)
name.onchange = () => validate('name', name)

team.onkeyup = () => validate('team', team)
team.onchange = () => validate('team', team)
