import axios from 'axios';
const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
axios.defaults.headers.common['X-CSRF-TOKEN'] = csrfToken;


const $ = document.querySelector.bind(document);
const $$ = document.querySelectorAll.bind(document);

const checkoutContainer = $('#checkoutContainer')
const alertOrderSuccess = $('#alertOrderSuccess')
const btnCheckout = $('#btnCheckout')
const ipAddress = $('#address')
const ipName = $('#name')
const ipPhone = $('#phone')
const ipdescription = $('#description')
const listItemRow = $$('.itemRow')




function getListItem() {
    const listItem = []
    const listQuantity = []
    listItemRow.forEach(item => {
        listItem.push(item.getAttribute('data-key'))
        listQuantity.push(item.getAttribute('data-quantity'))
    })
    return {
        listItem,
        listQuantity
    }
}

// console.log(listItemRow, getListItem())

const handleSubmitCheckout = () => {
    console.log(checkoutContainer, alertOrderSuccess, btnCheckout)

    btnCheckout.disabled = true
    ipAddress.disabled = true
    ipName.disabled = true
    ipPhone.disabled = true

    alertOrderSuccess.classList.remove('hidden')

    //call api
    const address = ipAddress.value
    const name = ipName.value
    const phone = ipPhone.value
    const description = ipdescription.value
    const listProduct = getListItem()
    const listQuantity = listProduct.listQuantity
    const listItem = listProduct.listItem

    axios.post('/checkout', {
        address,
        name,
        phone,
        description,
        listItem,
        listQuantity
    })
    .then(response => console.log(response))
    .catch(err => console.log(err))


}

btnCheckout.addEventListener('click', handleSubmitCheckout);




