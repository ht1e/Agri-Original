import Swal from "sweetalert2"
const $ = document.querySelector.bind(document)
const $$ = document.querySelectorAll.bind(document)

const password = $('#password')
const passwordCorrect = $('#passwordCorrect')
const correct = $('#correct')
const incorrect = $('#incorrect')

console.log(password, passwordCorrect, correct, incorrect, btnRegister);

const handlePasswordCorrectChange = (e) => {
    if(password.value == e.target.value) {
        correct.classList.remove('hidden')
        incorrect.classList.add('hidden')
    } else {
        correct.classList.add('hidden')
        incorrect.classList.remove('hidden')
    }
}

passwordCorrect.addEventListener('keyup', handlePasswordCorrectChange)

