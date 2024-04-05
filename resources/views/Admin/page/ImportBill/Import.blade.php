@extends('Admin.layout.main')

@section('content')
@php

$items = [1,2,3,4,5];
    
@endphp

<div class="p-2">
    <h1 class="text-xl text-center font-semibold">Hóa Đơn Nhập</h1>
    <div class="container px-5">
        <div class="grid grid-cols-7 leading-[60px] text-center">
            <div class="col-span-2">Mã Hóa Đơn Nhập</div>
            <div class="col-span-2">Thời Gian</div>
            <div class="col-span-2">Nhà Cung Cấp</div>
            <div class="col-span-1"></div>
        </div>
        @foreach ($data as $item)
        <div class="grid grid-cols-7 leading-10 py-2 text-center">
            <div class="col-span-2"><span>{{$item->HDN_Ma}}</span></div>
            <div class="col-span-2"><span>{{date('d/m/Y', strtotime($item->HDN_ThoiGian))}}</span></div>
            <div class="col-span-2"><span>{{$item->NCC_Ten}}</span></div>
            <div class="col-span-1"><a href="{{route('getDetailsImport', ['id' => $item->HDN_Ma])}}" class="px-2 py-1 bg-slate-400 rounded-md text-xs">Xem chi tiết</a></div>
        </div>
        @endforeach
        

    </div>
</div>
    
@endsection