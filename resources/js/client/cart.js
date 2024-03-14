import axios from 'axios';
const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
axios.defaults.headers.common['X-CSRF-TOKEN'] = csrfToken;


const $ = document.querySelector.bind(document);
const $$ = document.querySelectorAll.bind(document);

const listCheckCart = $$('.checkCart')
const formCheck = $('#formPostCheck')
const containerCheck = $('.containerCheck')
const checkAll = $('#checkAll')
const btnBuyNow = $('#btnBuyNow')
const listTrashCan = $$('.trashCan')
const listIPQuantity = $$('.ipQuantity')
const totalPrice = $('#totalPrice')
const ipTotal = $('#ipTotal')


console.log(listCheckCart, formCheck, containerCheck, checkAll, listTrashCan, listIPQuantity);


//format number
const formatNumber = (number) => {
    return number.toLocaleString('vi-VN', {currency: 'VND', style: 'currency'});
}




//API update cart
async function updateCart(idProduct, quantity) {
    axios.post('/update-cart',{
        idProduct,
        quantity
    })
    .then(response => console.log(response))
    .catch(err => console.log(err))
}


//canculator total
const canculatorTotal = () => {
    let total = 0
    listCheckCart.forEach(item => {
        if(item.checked) {
            const element = item.parentNode.parentNode.querySelector('.ipQuantity')
            console.log(element.value)
            total += (parseInt(element.value)*parseInt(element.getAttribute('data-price')))
        }
    })
    ipTotal.value = total
    total = formatNumber(total)
    totalPrice.innerHTML =`Tổng cộng: ${total}`
}


listCheckCart.forEach(item => {
    item.addEventListener('change', function () {
        canculatorTotal()
    })
})


//Check All In Cart
function CheckAll() {
    if(checkAll.checked) {
        listCheckCart.forEach((item) => {item.checked = true})
        canculatorTotal()
    }
    else {
        listCheckCart.forEach((item) => {item.checked = false})
        canculatorTotal()
    }    
}

checkAll.addEventListener('change', CheckAll);


//handle click TrashCan
function handleDelete(e) {
    e.target.parentNode.parentNode.parentNode.remove()
    //Call API
    const idProduct = e.target.getAttribute('data-key')
    const quantity = 0
    updateCart(idProduct, quantity)
}

listTrashCan.forEach(item => {
    item.addEventListener('click', handleDelete)
})


//handle quantity change
function handleChangeQuantity(e) {
    if(e.target.value <=0) {
        e.target.parentNode.parentNode.parentNode.remove()
    }
    //call API
    const idProduct = e.target.getAttribute('data-key')
    const quantity = e.target.value
    //console.log(idProduct, quantity)
    updateCart(idProduct, quantity)

    //tinh tong     
    const element = e.target.parentNode.parentNode.querySelector('.checkCart')
    if(element.checked)
        canculatorTotal()

    const price = parseInt(e.target.getAttribute('data-price'))
    const totalPriceOfProduct = e.target.parentNode.parentNode.querySelector('#totalPriceOfProduct')
    totalPriceOfProduct.innerHTML = formatNumber(price*quantity)
}

listIPQuantity.forEach(item => {
    item.addEventListener('change', handleChangeQuantity)
})




//get list checked
const getListChecked = () => {
    const items = []
    listCheckCart.forEach(item => {
        if(item.checked) {
            items.push(item.getAttribute('data-key'))
        }
    })
    return items
}

const handleCheckout = () => {
    const items = getListChecked()
    if(items.length > 0) { 
        const ipItems = $('#ipItems')
        ipItems.value = JSON.stringify(items)
        // console.log(ipItems, JSON.stringify(items))
    } 
    else {
        alert('Bạn chưa chọn sản phẩm nào')
    }

}

btnBuyNow.addEventListener('click', handleCheckout)






canculatorTotal()



