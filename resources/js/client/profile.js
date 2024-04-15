import axios from 'axios';
import Swal from 'sweetalert2'

const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
axios.defaults.headers.common['X-CSRF-TOKEN'] = csrfToken;

const $ = document.querySelector.bind(document);
const $$ = document.querySelectorAll.bind(document);

const information = $('#information')
const orders = $('#orders')

const inforOrder = $('#inforOrder')
const infor = $('#infor')

const containerBase = $('#containerBase')
const containerChange = $('#containerChange')
const btnShowChange = $('#btnShowChange')
const btnSave = $('#btnSave')
const htmlOfChange = containerChange.innerHTML


information.addEventListener('click', function (e) {
    e.target.classList.add('text-white')
    e.target.classList.add('bg-primary-color')
    orders.classList.remove('text-white')
    orders.classList.remove('bg-primary-color')
    infor.classList.remove('hidden')
    inforOrder.classList.add('hidden')


})
orders.addEventListener('click', function (e) {
    e.target.classList.add('text-white')
    e.target.classList.add('bg-primary-color')
    information.classList.remove('text-white')
    information.classList.remove('bg-primary-color')
    inforOrder.classList.remove('hidden')
    infor.classList.add('hidden')
})

btnShowChange.addEventListener('click', function (e) {
    containerBase.classList.toggle('hidden')
    containerChange.classList.toggle('hidden')
    btnSave.classList.toggle('hidden')

    if(e.target.innerText == 'Thay đổi') {
        e.target.innerText = 'Hủy bỏ'
        e.target.classList.remove('border-primary-color')
        e.target.classList.remove('text-primary-color')
        e.target.classList.add('border-red-400')
        e.target.classList.add('text-red-400')
        containerChange.innerHTML = `${htmlOfChange}`

    } else {
        e.target.innerText = 'Thay đổi'
        e.target.classList.add('border-primary-color')
        e.target.classList.add('text-primary-color')
        e.target.classList.remove('border-red-400')
        e.target.classList.remove('text-red-400')
    }
})


btnSave.addEventListener('click', function() {
    $('#formUpdate').submit()
})

