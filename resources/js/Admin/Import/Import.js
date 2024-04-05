import axios from "axios";
import { DateTime } from "luxon";
import Swal from "sweetalert2";
const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
axios.defaults.headers.common['X-CSRF-TOKEN'] = csrfToken;

const $ = document.querySelector.bind(document);
const $$ = document.querySelectorAll.bind(document);

const container = $('.containerItem')
const btnAddItem = $('#btnAddItem')
const btnAddImport = $('#btnAddImport')
const itemString = $('.item').outerHTML;  

console.log($('.idProduct').value)

window.handleDeleteItem = (element) => {
    element.parentNode.remove()
}

const handleAddItem = () => {

    //lay gia tri cua item truoc khi render
    const oldQuantity = $$('.quantity')
    const oldIdProduct = $$('.idProduct')
    const oldPrice = $$('.price')
    const listQuantity = []
    const listIdProduct = []
    const listPrice = []

    oldQuantity.forEach(item => {
        item.value? listQuantity.push(parseInt(item.value)) : listQuantity.push(0)
    })

    oldIdProduct.forEach(item => {
        item.value? listIdProduct.push(parseInt(item.value)) : listIdProduct.push(0)
    })

    oldPrice.forEach(item => {
        item.value? listPrice.push(parseInt(item.value)) : listPrice.push(0)
    })

    //render 
    const htmlOfContainer = container.innerHTML + itemString
    container.innerHTML = htmlOfContainer

    //gan gia tri cho item
    const newQuantity = $$('.quantity')
    const newIdProduct = $$('.idProduct')
    const newPrice = $$('.price')
    const length = newQuantity.length
    newQuantity.forEach((item, index) => {
        if(index < length -1 && listQuantity[index] != 0) {
            item.value = listQuantity[index]
        }
    })

    newIdProduct.forEach((item, index) => {
        if(index < length -1 && listIdProduct[index] != 0) {
            item.value = listIdProduct[index]
        }
    })

    newPrice.forEach((item, index) => {
        if(index < length -1 && listPrice[index] != 0) {
            item.value = listPrice[index]
        }
    })

}

btnAddItem.addEventListener('click', handleAddItem)



//handle post import 

const handlePostImport = () => {
    const selectProvider = $('#selectProvider')
    const quantity = $$('.quantity')
    const idProduct = $$('.idProduct')
    const price = $$('.price')
    const listQuantity = []
    const listIdProduct = []
    const listPrice = []


    if(selectProvider.value) {
        selectProvider.nextElementSibling.classList.add('hidden')
        selectProvider.classList.remove('border-red-400')
    }
    else {
        selectProvider.nextElementSibling.classList.remove('hidden')
        selectProvider.classList.add('border-red-400')
    }

    quantity.forEach(item => {

        if(item.value) {
            listQuantity.push(parseInt(item.value))
            item.nextElementSibling.classList.add('hidden')
            item.classList.remove('border-red-400')
        } else {
            item.nextElementSibling.classList.remove('hidden')
            item.classList.add('border-red-400')
            listQuantity.push(0)
        }
    })

    idProduct.forEach(item => {
        if(item.value) {
            listIdProduct.push(parseInt(item.value))
            item.nextElementSibling.classList.add('hidden')
            item.classList.remove('border-red-400')
        } else {
            item.nextElementSibling.classList.remove('hidden')
            item.classList.add('border-red-400')
            listIdProduct.push(0)
        }
    })

    price.forEach(item => {
        if(item.value) {
            listPrice.push(parseInt(item.value))
            item.nextElementSibling.classList.add('hidden')
            item.classList.remove('border-red-400')
        } else {
            item.nextElementSibling.classList.remove('hidden')
            item.classList.add('border-red-400')
            listPrice.push(0)
        }
    })


    if(!listQuantity.includes(0) && !listPrice.includes(0) && !listIdProduct.includes(0) && selectProvider.value) {
        const URL = '/admin/import/add'
        const idProvider = selectProvider.value

        axios.post(URL, {
            listIdProduct,
            listPrice,
            listQuantity,
            idProvider
        })
        .then(response => {
            Swal.fire({
                position: "center",
                icon: "success",
                title: response.data.success,
                showConfirmButton: false,
                timer: 1500
              })
              .then(() => {
                window.location.reload()
              });

            
        })
        .catch(error => console.log(error))
    }
}

btnAddImport.addEventListener('click', handlePostImport)
