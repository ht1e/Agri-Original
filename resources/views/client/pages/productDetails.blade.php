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
        <h1 class="leading-[60px] my-5 text-primary-color font-semibold text-2xl">{{$data->SP_Ten}}</h1>
        <p class="text-[14px]">{{$data->SP_MoTa}}</p>
        <h2 class="leading-[60px] my-5 font-bold">Loại sản phẩm: {{$data->DM_Ten}}</h2>
        <p class="leading-[60px] block my-5 font-bold">Giá: <span id="priceTotal">{{number_format($data->SP_Gia, 0, '', '.')}}đ</span></p>
        {{-- <form action="{{route('getCheckout')}}" method="get" id="formCheckout" @if(Auth::check()) data-check="1" @endif> --}}
            <label for="" class="block my-5 font-bold">
                Số lượng:
                <input class="px-2 py-1 text-center w-32 rounded-md border border-slate-300 focus:outline-none focus:border-primary-color" type="number" name="quantity" id="quantity" data-price="{{$data->SP_Gia}}" value="0">
                <input type="hidden" name="total" id="ipPriceTotal" value="{{$data->SP_Gia}}}">
            </label>
            <input type="hidden" id="idProduct" name="idProduct" value="{{$data->SP_Ma}}">
    
            <button class="rounded-md leading-[60px] block border px-3 mt-5 w-full text-white bg-primary-color text-[18px] " id="btnBuyNow" @if(Auth::check()) data-check="1" @endif>Mua Ngay</button>
        {{-- </form> --}}
        <button class="rounded-md leading-[60px] blockborder px-3 mt-5 w-full bg-white text-primary-color text-[18px] border border-primary-color hover:text-white hover:bg-primary-color" id="btnAddToCart" data-key="{{$data->SP_Ma}}" @if(Auth::check()) data-check="1" @endif>Thêm vào giỏ hàng</button>
    </div>
</div>
<div class="">
    @include('client.components.recomend', ['dataProducts' => $dataProducts, 'titleRecomend' => 'Sản phẩm cùng loại', 'data' => $data])
</div>

{{-- @if (Auth::check()) --}}
<div class="pl-2 py-4 hidden"  id="containerRecomend">
    <h1 class="font-semibold py-2">Có thể bạn thích</h1>
    <div class=" grid grid-cols-4 gap-2" id="recomendProduct" @if(Auth::check()) data-key="{{Auth::user()->id}}" @endif>
            {{-- @foreach($mostProducts as $key => $product)
            @include('client.components.cardProduct', ['item' => $product])
            @endforeach --}}
    </div>
</div>
{{-- @endif --}}

@endsection

@section('title')<title>Chi tiết sản phẩm</title>@endsection


@section('scripts')

    @vite('./resources/js/client/productdetails.js')
@endsection

