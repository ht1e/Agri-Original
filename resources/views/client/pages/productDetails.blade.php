@extends('client.layout.main')

@section('content')

@include('client.components.sidebar')
<div class="w-full grid grid-cols-3">
    <div class="col-span-2 border mr-2">
        <div class="h-[500px] p-4">
            <img class="w-full h-full" src="https://th.bing.com/th?id=OIF.jIm1E%2ft%2fsCHuVnvp9kuJBA&rs=1&pid=ImgDetMain" alt="">
        </div>
    </div>
    <div class="col-span-1 p-2 border">
        <h1 class="leading-[60px] my-5">Tên sản phẩm:</h1>
        <h2 class="leading-[60px] my-5">Loại sản phẩm:</h2>
        <span class="leading-[60px] block my-5">Giá:</span>

        <label for="" class="block my-5">
            Số lượng:
            <input class="px-2 py-1 text-center w-32 rounded-md border border-slate-300 focus:outline-none focus:border-[#009b49]" type="number" name="quantityProduct">
        </label>

        <button class="leading-[60px] block border px-3 mt-5 w-full text-white bg-[#009b49] text-[18px] ">Mua Ngay
            <div class=""></div>
            <span></span>
        </button>
        <button class="leading-[60px] blockborder px-3 my-5 w-full bg-white text-[#009b49] text-[18px] border border-[#009b49] hover:text-white hover:bg-[#009b49]">Thêm vào giỏ hàng</button>
    </div>

</div>

@endsection

