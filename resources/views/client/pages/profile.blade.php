@extends('client.layout.main')

@php
$items = [1,2,3,4,5];
    
@endphp

@section('content')
<div class="px-2 py-5 grid grid-cols-5 gap-4">
    <div class="sidebar col-span-1">
        <aside>
            <ul>
                <li class="px-4 py-2 leading-10 border"><a href="" class="">Thông tin cá nhân</a></li>
                <li class="px-4 py-2 leading-10 border"><a href="" class="">Thông tin đơn hàng</a></li>
            </ul>
        </aside>
    </div>
    <div class="col-span-4 p-2">
        <h1 class="text-xl font-bold text-primary-color">Thông tin đơn hàng</h1>

        <div class="grid grid-cols-5 text-center border-b-2 mt-10">
            <div class="">Mã đơn hàng</div>
            <div class="">Ngày đặt đơn</div>
            <div class="">Tổng giá trị</div>
            <div class="">Trạng thái đơn hàng</div>
            <div class=""></div>
        </div>

        @foreach ($dataOrders as $key => $item)
        <div class="grid grid-cols-5 text-center my-5 leading-10 border-b">
            <div class="">{{$item->DH_Ma}}</div>
            <div class="">{{$item->DH_ThoiGian}}</div>
            <div class="">{{number_format($item->DH_TongGiaTri, 0, '', '.')}}đ</div>
            <div class="">{{$item->TTDH_Ten}}</div>
            <div class="">
                <a href="{{route('getOrder', ['id' => $item->DH_Ma])}}" class="px-2 py-1 bg-blue-400 text-xs">Xem chi tiết</a>
            </div>
        </div>
        @endforeach
    </div>

</div>

@endsection
