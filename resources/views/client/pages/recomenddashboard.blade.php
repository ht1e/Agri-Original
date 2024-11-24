@extends('client.layout.main')

@section('content')
<div class=" w-full borrder border-2 rounded-md px-4 py-8">
    <h1 class="text-2xl font-bold">Sản phẩm tương đồng</h1>
    <div class="grid grid-cols-3 text-center " id="Title">

        <div class="col-span-1 px-2 py-4">Mã Sản Phẩm</div>
    
        <div class="col-span-1 px-2 py-4">Tên Sản Phẩm</div>
    
        <div class="col-span-1 px-2 py-4">Rate</div>
    
    </div>
    <div class="" id="box-same">
        {{-- <div class="row-same">
            <h1>Sản Phẩm: 1 - </h1>
            <div class="grid grid-cols-3 text-center sameOfProduct">
        
                <div class="col-span-1 px-2 py-4">Id san pham</div>
            
                <div class="col-span-1 px-2 py-4">Teen san pham</div>
            
                <div class="col-span-1 px-2 py-4">Rate</div>
            </div>
        
        </div> --}}
    </div>
    
</div>


<div class="borrder border-2 rounded-md px-4 py-8 my-4">
    <h1 class="text-2xl font-bold">Sản phẩm chọn</h1>
    <div class="grid grid-cols-3 text-center " id="Title">

        <div class="col-span-1 px-2 py-4">Mã Sản Phẩm</div>
    
        <div class="col-span-1 px-2 py-4">Tên Sản Phẩm</div>
    
        <div class="col-span-1 px-2 py-4">Rate</div>
    
    </div>

    <div class="" id="box-selected">
        <div class="row-same">
            <div class="grid grid-cols-3 text-center sameOfProduct" id="Title">
        
                <div class="col-span-1 px-2 py-4">Id san pham</div>
            
                <div class="col-span-1 px-2 py-4">Teen san pham</div>
            
                <div class="col-span-1 px-2 py-4">Rate</div>
            </div>
        
        </div>
    </div>
</div>

@endsection

@section('scripts')
@vite('./resources/js/client/showRecomend.js')
@endsection