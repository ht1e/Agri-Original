@extends('client.layout.main')

@section('content')
<div class=" w-full flex flex-row">
    <div class="sidebar basis-1/5">
        @include('client.components.sidebarHome', ['categories' => $categories])
    </div>
    <div class="basis-4/5 ">
        <div class="banner py-12 ">
            @include('client.components.banner')
        </div>
    </div>
</div>
<div class="products p-2">
    <h1 class="text-2xl font-bold text-primary-color">Sản Phẩm</h1>
    <div class="pl-2 py-4">
        <h1 class="font-semibold py-2">Sản phẩm mới</h1>
        <div class=" grid grid-cols-4 gap-2">
            @foreach($dataProducts as $key => $product)
            @include('client.components.cardProduct', ['item' => $product])
            @endforeach
        </div>
    </div>
    <div class="pl-2 py-4">
        <h1 class="font-semibold py-2">Sản phẩm bán chạy</h1>
        <div class=" grid grid-cols-4 gap-2">
            @foreach($dataProducts as $key => $product)
            @include('client.components.cardProduct', ['item' => $product])
            @endforeach
        </div>
    </div>
</div>

@endsection

@section('scripts')
    @vite('./resources/js/client/splide.js')
@endsection

@section('links')


@endsection