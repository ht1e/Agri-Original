import axios from 'axios';
const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
axios.defaults.headers.common['X-CSRF-TOKEN'] = csrfToken;


const $ = document.querySelector.bind(document);
const $$ = document.querySelectorAll.bind(document);

const listBtnAddToCart = $$('.btnAddToCart')

const sort = $('#sort')
const inputPrice = $('#inputPrice')
const output = $('output')

console.log(listBtnAddToCart)

const handleAddToCart = (e) => {
    const idProduct = e.target.getAttribute('data-key')

    console.log(idProduct)

    axios.post('/add-to-cart', {idProduct})
    .then((response) => console.log(response))
    .catch((error) => console.log(error))
}

listBtnAddToCart.forEach(btn => {
    btn.addEventListener('click', handleAddToCart)
})

const handleRange = (e) => {
    const valueInput = parseInt(e.target.value)
    console.log(valueInput.toLocaleString('de-DE', { minimumFractionDigits: 0 }))
    output.innerHTML = valueInput.toLocaleString('de-DE', { minimumFractionDigits: 0 })
}


inputPrice.addEventListener('input', handleRange)

