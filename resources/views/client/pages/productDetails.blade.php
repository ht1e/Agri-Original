@extends('client.layout.main')

@section('content')

@include('client.components.sidebarProduct', ['categories' => $categories])
<div class="w-full grid grid-cols-3">
    <div class="col-span-2 mr-2">
        <div class="h-[500px] p-4">
            <img class="w-[80%] h-full" src="{{$data->SP_HinhAnh}}" alt="">
        </div>
    </div>
    <div class="col-span-1 p-2">
        <h1 class="leading-[60px] my-5 text-primary-color font-semibold">{{$data->SP_Ten}}</h1>
        <h2 class="leading-[60px] my-5">Loại sản phẩm: {{$data->DM_Ten}}</h2>
        <p class="leading-[60px] block my-5">Giá: <span id="priceTotal">{{number_format($data->SP_Gia, 0, '', '.')}}d</span></p>
        <form action="{{route('getCheckout')}}" method="get" id="formCheckout" @if(Auth::check()) data-check="1" @endif>
            <label for="" class="block my-5">
                Số lượng:
                <input class="px-2 py-1 text-center w-32 rounded-md border border-slate-300 focus:outline-none focus:border-primary-color" type="number" name="quantity" id="quantity" data-price="{{$data->SP_Gia}}">
                <input type="hidden" name="total" id="ipPriceTotal" value="2000">
            </label>
            <input type="hidden" name="idProduct" value="{{$data->SP_Ma}}">
    
            <button class="leading-[60px] block border px-3 mt-5 w-full text-white bg-primary-color text-[18px] " id="btnBuyNow">Mua Ngay</button>
        </form>
        <button class="leading-[60px] blockborder px-3 mt-5 w-full bg-white text-primary-color text-[18px] border border-primary-color hover:text-white hover:bg-primary-color" id="btnAddToCart" data-key="{{$data->SP_Ma}}" @if(Auth::check()) data-check="1" @endif>Thêm vào giỏ hàng</button>
    </div>
</div>
<div class="">
    @include('client.components.recomend', ['dataProducts' => $dataProducts, 'titleRecomend' => 'Sản phẩm cùng loại'])
</div>

@endsection


@section('scripts')

    @vite('./resources/js/client/productdetails.js')
@endsection

