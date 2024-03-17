import axios from 'axios';
import Swal from 'sweetalert2'

const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
axios.defaults.headers.common['X-CSRF-TOKEN'] = csrfToken;


const $ = document.querySelector.bind(document);
const $$ = document.querySelectorAll.bind(document);

const listBtnAddToCart = $('#btnAddToCart')
const priceTotal = $('#priceTotal')
const inputPrice = $('#ipPriceTotal')
const quantity = $('#quantity')

const handleQuantityChange = (e) => {
    const quantityvalue = e.target.value
    const price = parseInt(e.target.getAttribute('data-price'))

    const total = quantityvalue*price

    inputPrice.value =total
    priceTotal.innerHTML = total.toLocaleString('vi-VN', {currency: 'VND', style: 'currency'});

}

quantity.addEventListener('change', handleQuantityChange)


const handleAddToCart = (e) => {
    const idProduct = e.target.getAttribute('data-key')
    const quantityOfProduct = quantity.value

    console.log(idProduct)

    axios.post('/add-to-cart', {idProduct, quantityOfProduct})
    .then((response) => {
        Swal.fire({
            position: "center",
            icon: "success",
            title: response.data.message,
            showConfirmButton: false,
            timer: 1500
          });
        console.log(response)
    })
    .catch((error) => console.log(error))
}

listBtnAddToCart.addEventListener('click', handleAddToCart)



