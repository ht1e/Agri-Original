import axios from 'axios';
const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
axios.defaults.headers.common['X-CSRF-TOKEN'] = csrfToken;

const $ = document.querySelector.bind(document);
const $$ = document.querySelectorAll.bind(document);

const recomendBox = $('#recomendProduct')
const containerRecomend = $('#containerRecomend')

// console.log(containerRecomend.classList.contains('hidden'));

function recomend() {
    axios.get('/recomend/ProductsOfUser')
        .then(res => {
            // console.log(res);
            //lay trang thai
            const STATUS = res.data.status
            //lay list san pham
            let listProductBuyed = res.data.databuyed
            let listProductCart = res.data.datacart

            //lay san pham nguoi dung click
            const listProductClicked = JSON.parse(localStorage.getItem('productsClicked'))

            console.log(listProductBuyed, listProductCart, listProductClicked)

            const listProducts = []

            if (listProductBuyed) {
                listProductBuyed.forEach(p => {
                    if (!listProducts.includes(p))
                        listProducts.push(p.ctdh_masp)
                })
            }
            if (listProductCart) {
                listProductCart.forEach(p => {
                    if (!listProducts.includes(p))
                        listProducts.push(p.ctgh_masp)
                })
            }
            if (listProductClicked) {
                listProductClicked.forEach(p => {
                    if (!listProducts.includes(p))
                        listProducts.push(p)
                })
            }

            //goi api lay san pham tuong dong
            console.log(STATUS, listProducts)

            // if(STATUS == "Success") {
            let listRecomend = []
            const apiRcm = "http://127.0.0.1:5557/apiRecomend?id="
            const promises = []

            listProducts.forEach(product => {

                promises.push(
                    axios.get(apiRcm + product)
                        .then(response => {
                            console.log(response)
                            const responseRcm = response.data.data

                            //push to arr
                            responseRcm.forEach(pd => listRecomend.push(pd))
                            console.log(listRecomend)
                        })
                        .catch(err => console.log(err))
                )
            })

            const newProducts = []
            const mostProducts = []

            if (document.title == "Trang chủ") {

                const apiNewProducts = 'http://127.0.0.1:8000/newproducts'
                const apiMostProducts = 'http://127.0.0.1:8000/mostproducts'

                promises.push(
                    axios.get(apiNewProducts)
                        .then(response => {
                            console.log(response)
                            response.data.newProducts.forEach(p => newProducts.push(p.sp_ma))
                        })
                        .catch(err => console.log(err))
                )

                promises.push(
                    axios.get(apiMostProducts)
                        .then(response => {
                            console.log(response)
                            response.data.mostProducts.forEach(p => mostProducts.push(p.sp_ma))
                        })
                        .catch(err => console.log(err))
                )
            }
            
            //trang chi tiet san pham
            let currentProduct = undefined
            if(document.title == "Chi tiết sản phẩm") {
                currentProduct =  $('#idProduct').getAttribute('value')
            }

            //trang gio hang

            let cart = undefined
            if(document.title == "Giỏ hàng") {
                cart = listProductCart.map(x => x.ctgh_masp)
            }
            // console.log(cart)

            const listProductsHandled = []
            Promise.all(promises).then(() => {
                console.log(listRecomend[listRecomend.length - 1])
                //sort with rate
                listRecomend.sort((a, b) => {
                    if (a.rate > b.rate) {
                        // console.log(a.SP_Ma+ " : "+ a.rate + " > " + b.SP_Ma + " : "+ b.rate )
                        return 1
                    }
                    if (a.rate < b.rate) {
                        // console.log(a.SP_Ma+ " : "+ a.rate + " < " + b.SP_Ma+ " : "+ b.rate)
                        return -1
                    }
                    return 0
                })
                // console.log(listRecomend[listRecomend.length-1], listRecomend[listRecomend.length-2], listRecomend[listRecomend.length-3], listRecomend[listRecomend.length-4])

                //loai bo property rate
                listRecomend = listRecomend.map(l => {
                    return {
                        SP_Gia: l.SP_Gia,
                        SP_HinhAnh: l.SP_HinhAnh,
                        SP_Ma: l.SP_Ma,
                        SP_MoTa: l.SP_MoTa,
                        SP_Ten: l.SP_Ten
                    }
                })
                // console.log(listRecomend[listRecomend.length-1], listRecomend[listRecomend.length-2], listRecomend[listRecomend.length-3], listRecomend[listRecomend.length-4])
                // console.log(JSON.stringify(listRecomend.pop()) === JSON.stringify(listProductsHandled[0]))
                // console.log(JSON.stringify(listRecomend.pop()), JSON.stringify(listProductsHandled[0]))
                // console.log(listProductsHandled)

                if (listRecomend.length > 0) {
                    //lay 4 san pham co rate cao nhat && loai bo cac san pham da co

                    //old way get bug with data recomend too few
                    // while (listProductsHandled.length < 4 ) {
                    //     const item = listRecomend.pop()
                    //     if(JSON.stringify(item) === JSON.stringify(listProductsHandled[0])
                    //         || JSON.stringify(item) === JSON.stringify(listProductsHandled[1])
                    //         || JSON.stringify(item) === JSON.stringify(listProductsHandled[2])
                    //         || JSON.stringify(item) === JSON.stringify(listProductsHandled[3])
                    //         || newProducts.includes(item.SP_Ma)
                    //         || mostProducts.includes(item.SP_Ma))
                    //         console.log(true) 
                    //     else {  
                    //         listProductsHandled.push(item)  
                    //     }
                    // }

                    listRecomend.forEach(item => {
                        if (JSON.stringify(item) === JSON.stringify(listProductsHandled[0])
                            || JSON.stringify(item) === JSON.stringify(listProductsHandled[1])
                            || JSON.stringify(item) === JSON.stringify(listProductsHandled[2])
                            || JSON.stringify(item) === JSON.stringify(listProductsHandled[3])
                            || newProducts.includes(item.SP_Ma)
                            || mostProducts.includes(item.SP_Ma)
                            || (currentProduct && item.SP_Ma == currentProduct)
                            || (cart && cart.includes(item.SP_Ma))
                        )
                            console.log(true)
                        else {
                            if(listProductsHandled.length < 4)
                                listProductsHandled.push(item)
                        }
                    })

                    //console.log(listProductsHandled)
                    //them san pham goi y

                    const html = listProductsHandled.map((pds, index) => {
                        return `
                            <div class="cardProduct w-full  bg-slate-200 rounded-md border text-center p-2">
                                    <div class="h-[200px]">
                                        <a class="viewdetail" href="/products/productDetails/${pds.SP_Ma}" data-key="${pds.SP_Ma}">
                                            <img class="h-full w-full  rounded-t-md" src="${pds.SP_HinhAnh}" alt="">
                                        </a>
                                    </div>
                                    <div class="infor py-2 px-2">
                                        <h1 class="h-[50px]  overflow-hidden">${pds.SP_Ten}</h1>
                                        <p class="text-xs h-[50px] lowercase overflow-hidden">${pds.SP_MoTa}</p>
                                        <h2 class="">${pds.SP_Gia.toLocaleString('vi-VN')}₫</h2>
                                    </div>
                                    <div class="">
                                            <a href="/products/productDetails/${pds.SP_Ma}" class="viewdetail text-[12px] px-2 py-1 border bg-primary-color rounded-[10%] hover:scale-105 hover:rotate-3 text-white" datakey="${pds.SP_Ma}">Xem chi tiết</a>
                                    </div>  
                            </div>
                            `
                    }).join(" ")

                    recomendBox.innerHTML = html

                    //them su kien click cho cac the san pham

                    recomendUserClick()

                    //hien thi recomend

                    if (listProductsHandled.length > 0)
                        containerRecomend.classList.remove('hidden')

                }
            })
        })
        .catch(err => console.log(err))
}

if (recomendBox)
    recomend()

// recomend on click event to products

function recomendUserClick() {
    const listcard = $$(".viewdetail")
    // console.log(listcard)
    listcard.forEach(i => {
        i.addEventListener("click", handleclickProduct)
    })
}


//xu ly su kien click the san pham

const productsClicked = []


function handleclickProduct(e) {
    // console.log(productsClicked)
    const listClicked = JSON.parse(localStorage.getItem("productsClicked"))

    if (listClicked) {
        listClicked.forEach(x => {
            if (!productsClicked.includes(x))
                productsClicked.push(x)
        })
    }

    const id = parseInt(e.target.getAttribute(('datakey')))
    productsClicked.push(id)
    // console.log(JSON.stringify(productsClicked))
    localStorage.setItem('productsClicked', JSON.stringify(productsClicked))
    recomend()

}

if (containerRecomend && containerRecomend.classList.contains('hidden'))
    recomendUserClick()




