@extends('client.layout.main')

@section('content')
    <div class="w-full h-full p-2 relative">
        <h1 class="px-2 py-1 text-3xl">Giỏ Hàng</h1>

        <div class="w-full mt-5">
            <div class="title grid grid-cols-11 mb-5">
                <div class="col-span-2 text-xl font-semibold ml-1.5"><span class="text-xs px-2">Chọn tất cả</span><input class="translate-y-1" type="checkbox" name="" id="checkAll"></div>
                <div class="col-span-2 text-center text-xl font-semibold">Sản phẩm</div>
                <div class="col-span-2 text-center text-xl font-semibold">Số lượng</div>
                <div class="col-span-2 text-center text-xl font-semibold">Đơn giá</div>
                <div class="col-span-2 text-center text-xl font-semibold">Tổng</div>
                <div class="col-span-1 text-center text-xl font-semibold"></div>
            </div>
            <div class="content">
                 @foreach($dataCart as $key => $item)
                <div class="rowItem h-[70px] border-t border-t-[#009b49] mb-2">
                    <div class="container grid grid-cols-11 h-full">
                        <div class="col-span-2 flex justify-center items-center text-[14px]"><input type="checkbox" class="checkCart" data-key="{{$item->SP_Ma}}"></div>
                        <div class="col-span-2 flex items-center text-[14px]"><img class="h-[20px] w-[30px]" src="https://www.hoptri.com/media/k2/items/cache/23da450944f0818162562a06dc761501_XL.jpg" alt=""><span class="ml-4">{{$item->SP_Ten}}</span></div>
                        <div class="col-span-2 flex justify-center items-center text-[14px]">
                            <input type="number" class="ipQuantity w-[50px] text-center outline-none focus:border-[#009b49] border rounded-md" value="{{$item->CTGH_SoLuong}}" name="quantity" data-key="{{$item->CTGH_MaSP}}"  data-price="{{$item->SP_Gia}}">
                        </div>
                        <div class="col-span-2 flex justify-center items-center text-[14px]">{{number_format($item->SP_Gia, 0, '', '.')}}₫</div>
                        <div class="col-span-2 flex justify-center items-center text-[14px]" id="totalPriceOfProduct">{{number_format($item->SP_Gia*$item->CTGH_SoLuong, 0, '', '.')}}₫</div>
                        <div class="col-span-1 flex justify-center items-center text-[14px]"><i class="fa-solid fa-trash-can cursor-pointer trashCan" data-key="{{$item->SP_Ma}}"></i></div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="flex justify-end mt-5">
            <form action="{{route('getCheckout')}}" id="formPostCheck" method="get" >
                <div class="containerCheck">
                    <input type="hidden" name="items" id="ipItems">
                    <input type="hidden" name="total" id="ipTotal">
                </div>
                <span id="totalPrice" class="block py-2 px-4 text-[18px]">Tổng: 0₫</span>
                <button class="px-4 py-1 bg-primary-color text-white" id="btnBuyNow">Mua Ngay</button>
            </form>
            
        </div>
    </div>
@endsection

@section('scripts')
    @vite('./resources/js/client/cart.js')
@endsection