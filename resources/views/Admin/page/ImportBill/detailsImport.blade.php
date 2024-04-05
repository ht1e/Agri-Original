@extends('Admin.layout.main')

@section('content')
<div class="p-2">
    <h1 class="text-center font-semibold text-xl">Chi Tiết Hóa Đơn Nhập</h1>
    <div class="border-b">
        <h2 class="leading-8 ">Mã hóa đơn nhập: <span class="text-slate-400">{{$importBill->HDN_Ma}}</span></h2>
        <h2 class="leading-8 ">Thời gian: <span class="text-slate-400">{{$importBill->HDN_ThoiGian}}</span></h2>
        <h2 class="leading-8 ">Nhà cung cấp: <span class="text-slate-400">{{$importBill->NCC_Ten}}</span></h2>
    </div>
    <div class="container py-5">
        <div class="grid grid-cols-4 text-center leading-[60px]">
            <div class="col-span-2"><span>Tên Sản Phẩm</span></div>
            <div class="col-span-1"><span>Số lượng</span></div>
            <div class="col-span-1"><span>Giá</span></div>
        </div>
        @foreach ($data as $item)
        <div class="grid grid-cols-4 text-center leading-10">
            <div class="col-span-2"><span>{{$item->SP_Ten}}</span></div>
            <div class="col-span-1"><span>{{$item->CTHDN_Soluong}}</span></div>
            <div class="col-span-1"><span>{{$item->CTHDN_Gia}}</span></div>
        </div>
        @endforeach

    </div>
</div>
@endsection