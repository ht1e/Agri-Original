@extends('Admin.layout.main')

@section('content')
<div class="p-2">
    <h1 class="text-center text-xl font-semibold">Thêm sản phẩm mới</h1>
    <div class="p-5">
        <div class="mb-6">
            <label for="" class="relative">Nhà cung cấp: 
                <select name="idProvider" id="selectProvider" class="border px-2 rounded-md">
                    <option value="" selected disabled hidden>--- Chọn nhà cung cấp ---</option>
                    @foreach ($listProvider as $item)
                    <option value="{{$item->NCC_Ma}}">{{$item->NCC_Ten}}</option>
                    @endforeach
                </select>
                <span class="text-xs absolute right-0 -bottom-5 text-red-400 hidden">Không được để trống</span>
            </label>
        </div>
        <div class="containerItem">
            <div class="item my-4 px-4 py-5 border rounded-md relative">
                <label for="" class="relative">Sản phẩm: 
                    <select class="idProduct border rounded-md px-2" name="" id="">
                        <option value="" selected disabled hidden>--- Vui lòng chọn sản phẩm ---</option>
                        @foreach ($listProduct as $item)
                        <option value="{{$item->SP_Ma}}">{{$item->SP_Ten}}</option>
                        @endforeach
                    </select>
                    <span class="text-xs absolute right-0 -bottom-5 text-red-400 hidden">Không được để trống</span>
                </label>
                <label class="ml-10 relative" for="">Số lượng: <input class="text-center border rounded-md quantity w-[50px] relative" type="number" name="" id=""> <span class="text-xs absolute right-0 -bottom-5 text-red-400 hidden">Không được để trống</span></label>
                <label class="ml-10 relative" for="">Giá: <input class="text-center border rounded-md price w-[100px]" type="number" name="" id=""> <span class="text-xs absolute right-0 -bottom-5 text-red-400 hidden">Không được để trống</span></label>
                <i class="fa-solid fa-circle-xmark absolute right-4 top-1/2 -translate-y-1/2 text-red-400 cursor-pointer hover:scale-110" onclick="handleDeleteItem(this)"></i>
            </div>
        </div>
        <div class="flex justify-end">
            <i class="fa-solid fa-circle-plus text-2xl text-green-400 cursor-pointer hover:scale-110" id="btnAddItem"></i>
        </div>
        <div class="">
            <button class="px-4 py-2 border rounded-md border-primary-color text-primary-color" id="btnAddImport">Thêm hóa đơn nhập</button>
        </div>
    </div>
</div>    
@endsection

@section('scripts')
    @vite('./resources/js/Admin/Import/Import.js')
@endsection