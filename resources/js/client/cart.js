import axios from 'axios';
import Swal from 'sweetalert2'
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

    Swal.fire({
        title: "Bạn có chắc muốn xóa?",
        text: "Sản phẩm có thể giúp ích cho bạn!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Xóa ngay"
      }).then((result) => {
        if (result.isConfirmed) {  
            Swal.fire({
            title: "Đã xóa!",
            text: "Sản phẩm đã được xóa khỏi giỏ hàng của bạn",
            icon: "success"
            });
            e.target.parentNode.parentNode.parentNode.remove()
            //Call API
            const idProduct = e.target.getAttribute('data-key')
            const quantity = 0
            updateCart(idProduct, quantity)
        }
      });

    
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

const handleCheckout = (e) => {
    

    const items = getListChecked()
    if(items.length > 0) { 
        const ipItems = $('#ipItems')
        ipItems.value = JSON.stringify(items)

        return true
        // console.log(ipItems, JSON.stringify(items))
    } 
    else {
        let timerInterval;
        Swal.fire({
            icon: 'warning',
            title: "Bạn chưa chọn sản phẩm nào!",
            html: "Vui lòng chọn sản phẩm bạn muốn mua",
            timer: 2000,
            timerProgressBar: true,
            didOpen: () => {
                Swal.showLoading();
                const timer = Swal.getPopup().querySelector("b");
                timerInterval = setInterval(() => {
                timer.textContent = `${Swal.getTimerLeft()}`;
                }, 100);
            },
            willClose: () => {
                clearInterval(timerInterval);
            }
            }).then((result) => {
            /* Read more about handling dismissals below */
            if (result.dismiss === Swal.DismissReason.timer) {
                console.log("I was closed by the timer");
            }
        });
        e.preventDefault()
    }

}

formCheck.addEventListener('submit',  handleCheckout)

//btnBuyNow.addEventListener('click', handleCheckout)

//format total
canculatorTotal()



