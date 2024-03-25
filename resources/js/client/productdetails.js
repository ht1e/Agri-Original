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
const formCheckout = $('#formCheckout')

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

    if(e.target.getAttribute('data-check')) {
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
    else {
        Swal.fire({
            icon: "error",
            title: "Bạn chưa đăng nhập",
            text: "Vui lòng đăng nhập để có giỏ hàng.",
            footer: '<a href="http://127.0.0.1:8000/login">Đăng nhập ngay tại đây.</a>'
          });
    }

    
}

listBtnAddToCart.addEventListener('click', handleAddToCart)

//handle submit formCheckout

const handleSubmitformCheckout = (e) => {
    
    if(e.target.getAttribute('data-check')) {

    } 
    else {
        Swal.fire({
            icon: "error",
            title: "Bạn chưa đăng nhập",
            text: "Vui lòng đăng nhập trước khi mua hàng.",
            footer: '<a href="http://127.0.0.1:8000/login">Đăng nhập ngay tại đây.</a>'
          });
        e.preventDefault()
    }

   
}

formCheckout.addEventListener('submit', handleSubmitformCheckout)



