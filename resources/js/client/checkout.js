import axios from 'axios';
import Swal from 'sweetalert2'
const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
axios.defaults.headers.common['X-CSRF-TOKEN'] = csrfToken;


const $ = document.querySelector.bind(document);
const $$ = document.querySelectorAll.bind(document);

const btnCheckout = $('#btnCheckout')

// const checkoutContainer = $('#checkoutContainer')
// const alertOrderSuccess = $('#alertOrderSuccess')

// const ipAddress = $('#address')
// const ipName = $('#name')
// const ipPhone = $('#phone')
// const ipdescription = $('#description')
// const listItemRow = $$('.itemRow')


//payment-option

const paymentOptions = $$(".payment-option")

paymentOptions.forEach(p => {
    p.addEventListener('click', handleClickPaymentOption)
})

function handleClickPaymentOption(e) {
    const item = e.target

    
    


    paymentOptions.forEach(p => {
        p.classList.remove('active')
        p.classList.remove('bg-primary-color')
        p.classList.remove('text-white')
    })

    item.classList.add('active')
    item.classList.add('bg-primary-color')
    item.classList.add('text-white')


    console.log(e.target.classList.contains('active'))

    console.log(item)
    
}





function getListItem() {
    const listItem = []
    const listQuantity = []
    $$('.itemRow').forEach(item => {
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
    //console.log(checkoutContainer, alertOrderSuccess, btnCheckout)

    // btnCheckout.disabled = true
    // ipAddress.disabled = true
    // ipName.disabled = true
    // ipPhone.disabled = true

    //alertOrderSuccess.classList.remove('hidden')

    //call api
    const address = $('#address').value
    const name = $('#name').value
    const phone = $('#phone').value
    const description = $('#description').value
    const listProduct = getListItem()
    const listQuantity = listProduct.listQuantity
    const listItem = listProduct.listItem
    const total = parseInt($('#totalPrice').getAttribute('data-price'))


    console.log(address)
    console.log(name)
    console.log(phone)
    console.log(description)
    console.log(listProduct)
    console.log(listQuantity)
    console.log(listItem)
    console.log(total)
    

    //post don hang

    axios.post('/checkout', {
        address,
        name,
        phone,
        description,
        listItem,
        listQuantity,
        total
    })
    .then(response => {
        console.log(response)
        Swal.fire({
            icon: "success",
            title: response.data.message,
            text: "Bạn sẽ được chuyển về trang chủ",
            footer: `<a href="http://127.0.0.1:8000/profile/ordered/${response.data.idOrder}">Bạn có muốn xem đơn hàng?</a>`
          }).then((result) => {
            if(result.isConfirmed) {
                window.location = "/"
            }
          });

        // xoa cac bien tam

        localStorage.removeItem('BuyNow')
        localStorage.removeItem('totalBuy')
        localStorage.removeItem('listItemChecked')

    })
    .catch(err => console.log(err))


    


}

const formPayment = $('#formpayment')

formPayment.addEventListener('submit', handleSubmitPayment)

function handleSubmitPayment(e) {
    const vnpay = $('#vnpay')
    console.log(vnpay.classList.contains('active'))
    //xu ly thanh toan

    //thanh toan vnpay
    if(vnpay.classList.contains('active')) {

        console.log("vnpay")

        return true

    } else { //thanh toan khi nhan hang

        handleSubmitCheckout()
        e.preventDefault()
    }

}


function handlePayment() {
    
    // const formPayment = $('#formpayment')

    const address = $('#address').value
    const name = $('#name').value
    const phone = $('#phone').value
    const description = $('#description').value

    const infor = {
        address,
        name,
        phone,
        description
    }

    localStorage.setItem('infor', JSON.stringify(infor))

}

btnCheckout.addEventListener('click', handlePayment);



function initCheckout() {

    const boxPayment = $('#boxPayment')

    const containerItem = $("#contentTable")
    const containerTotal = $('#totalTable')
    const totalCheckout = $('#totalCheckout')

    //kiem tra buynow

    const buynow = JSON.parse(localStorage.getItem('BuyNow'))

    if(buynow) {

        axios.get("/getItem/"+buynow.id)
        .then(response => {

            const item = response.data.data 

            const html = `
                <div class="itemRow grid grid-cols-5 px-5 py-2" data-key="${item.SP_Ma}" data-quantity="${buynow.quantity}">
                    <div class="col-span-2 text-center flex items-center"><img class="h-[20px] w-[30px]" src="${item.SP_HinhAnh}" alt=""><span class="ml-4">${item.SP_Ten}</span></div>
                    <div class="col-span-1 text-center"><span>${buynow.quantity}</span></div>
                    <div class="col-span-1 text-center"><span>${item.SP_Gia.toLocaleString('vi-VN')}đ</span></div>
                    <div class="col-span-1 text-center"><span>${(item.SP_Gia*buynow.quantity).toLocaleString('vi-VN')}đ</span></div>
                </div>
            `
            containerItem.innerHTML += html
            containerTotal.innerHTML = `Tạm tính: ${buynow.total.toLocaleString('vi-VN')}đ`
            totalCheckout.innerHTML = `Tổng cộng:<span class="ml-2" id="totalPrice" data-price="${buynow.total}">${(buynow.total + 30000).toLocaleString('vi-VN')}</span>đ`
            boxPayment.innerHTML = `<input type="hidden" name="total" value="${buynow.total + 30000}">`  
        })
        .catch(err => console.log(err))

    }
    //end buynow

    const items = JSON.parse(localStorage.getItem('listItemChecked'))
    const total = parseInt(JSON.parse(localStorage.getItem('totalBuy')))
    if(items && total) {
        const promises = []
        const listItem = []

        items.forEach(item => {
            promises.push(
                axios.get("/getItemBuy/"+item)
                .then(response => {
                    listItem.push(response.data.data)
                })
                .catch(err => console.log(err))
            )
        })

        Promise.all(promises).then(() => {
            console.log(listItem, total)
            const html = listItem.map(item => {
                return `
                    <div class="itemRow grid grid-cols-5 px-5 py-2" data-key="${item.SP_Ma}" data-quantity="${item.CTGH_SoLuong}">
                        <div class="col-span-2 text-center flex items-center"><img class="h-[20px] w-[30px]" src="${item.SP_HinhAnh}" alt=""><span class="ml-4">${item.SP_Ten}</span></div>
                        <div class="col-span-1 text-center"><span>${item.CTGH_SoLuong}</span></div>
                        <div class="col-span-1 text-center"><span>${item.SP_Gia.toLocaleString('vi-VN')}đ</span></div>
                        <div class="col-span-1 text-center"><span>${(item.SP_Gia*item.CTGH_SoLuong).toLocaleString('vi-VN')}đ</span></div>
                    </div>
                `

            }).join(" ")

            containerItem.innerHTML += html
            containerTotal.innerHTML = `Tạm tính: ${total.toLocaleString('vi-VN')}đ`
            totalCheckout.innerHTML = `Tổng cộng:<span class="ml-2" id="totalPrice" data-price="${total}">${(total + 30000).toLocaleString('vi-VN')}</span>đ`
            boxPayment.innerHTML = `<input type="hidden" name="total" value="${total + 30000}">`  
        })
    }
}

initCheckout()




//kiem tra ket qua trang thai thanh toan tu vnpay tra ve

function handlePaymentStatus() {
    // console.log(window.location.href)
    const params = new URLSearchParams(window.location.href)

    if(params.has('vnp_TransactionStatus')) {
        // console.log(params, params.get('vnp_TransactionStatus') == "00")
        const status =  params.get('vnp_TransactionStatus')

        //kiem tra trang thai thanh toan 00 : thanh cong
        if(status == '00') {
            const infor = JSON.parse(localStorage.getItem('infor'))
            console.log(infor)
            
            $('#address').value = infor.address
            $('#name').value = infor.name
            $('#phone').value = infor.phone
            $('#description').value = infor.description

            localStorage.removeItem('infor')

            Swal.fire({
                position: "center",
                icon: "success",
                title: "Thanh toán thành công",
                showConfirmButton: false,
                timer: 1500
            });

            setTimeout(handleSubmitCheckout, 1600)
        }

    }
    // for (const param of params) {
    //     console.log(param);
    // }
}

handlePaymentStatus()

// $('#formpayment').submit()






