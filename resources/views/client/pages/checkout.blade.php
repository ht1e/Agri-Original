@extends('client.layout.main')


{{-- @section('alertDialog')
    <div class="absolute w-[450px] bg-slate-100 drop-shadow-2xl top-[200px] left-1/2 -translate-x-1/2 text-center px-5 py-5 border border-primary-color hidden" id="alertOrderSuccess">
        <div class="">
            <p class="text-xl px-2">Đơn hàng đã được đặt thành công.</p>
            <i class="fa-regular fa-circle-check text-xl text-primary-color"></i>
        </div>
        <div class=" flex justify-between mt-5">
            <a href="" class="px-4 py-2 bg-primary-color text-white rounded-md group"> <span>Xem đơn hàng</span><i class="fa-solid fa-receipt group-hover:rotate-12 ml-2"></i></a>
            <a href="{{route('getCart')}}" class="px-4 py-2 bg-primary-color text-white rounded-md group"> <span>Trở về giỏ hàng</span><i class="fa-solid fa-cart-shopping group-hover:rotate-12 ml-2"></i></a>
        </div>
    </div>

@endsection --}}

@section('content')
    <div class="py-5" id="checkoutContainer">
        <div class="title flex justify-between text-primary-color"><h1 class="px-2 py-4 text-xl font-bold ">Thanh Toán</h1><a class="px-2 py-4 text-xl font-bold" href="{{route('getCart')}}">Giỏ Hàng<i class="fa-solid fa-arrow-right ml-1"></i></a></div>
        <div class="infor border-b py-2">
            <h2 class="px-1 py-2 text-[18px] font-semibold">Thông tin người nhận</h2>
            <div class="flex justify-between px-5">
                <label for="">Địa chỉ: 
                    <input class="px-2 py-1 focus:outline-none border border-primary-color rounded-md" type="text" name="address" id="address">
                </label>
                <label for="">Họ và tên:
                    <input class="px-2 py-1 focus:outline-none border border-primary-color rounded-md" type="text" name="name" id="name">
                </label>
                <label for="">Số điện thoại:
                    <input class="px-2 py-1 focus:outline-none border border-primary-color rounded-md" type="text" name="phone" id="phone">
                </label>
            </div>
            <div class="px-5 mt-5">
                <label for="">Ghi chú:
                    <textarea class="px-2 py-1 focus:outline-none border border-primary-color rounded-md" type="text" name="description" id="description" cols="40" rows="5"></textarea>
                </label>
            </div>
        </div>
        <div class="content mt-4 border-b py-2">
            <div class=""><h2 class="px-1 py-2 text-[18px] font-semibold">Thông tin sản phẩm</h2></div>
            <div class="titleTable grid grid-cols-5 px-5 py-2">
                <div class="col-span-2 text-center font-semibold"><span>Tên Sản Phẩm</span></div>
                <div class="col-span-1 text-center font-semibold"><span>Số Lượng</span></div>
                <div class="col-span-1 text-center font-semibold"><span>Đơn Giá</span></div>
                <div class="col-span-1 text-center font-semibold"><span>Tổng</span></div>
            </div>
            <div class="contentTable mt-2">
                @foreach($data as $key => $item)
                <div class="itemRow grid grid-cols-5 px-5 py-2" data-key="{{$item->SP_Ma}}" data-quantity="{{$item->CTGH_SoLuong}}">
                    <div class="col-span-2 text-center flex items-center"><img class="h-[20px] w-[30px]" src="https://www.hoptri.com/media/k2/items/cache/23da450944f0818162562a06dc761501_XL.jpg" alt=""><span class="ml-4">{{$item->SP_Ten}}</span></div>
                    <div class="col-span-1 text-center"><span>{{$item->CTGH_SoLuong}}</span></div>
                    <div class="col-span-1 text-center"><span>{{number_format($item->SP_Gia, 0, '', '.')}}đ</span></div>
                    <div class="col-span-1 text-center"><span>{{number_format($item->SP_Gia*$item->CTGH_SoLuong, 0, '', '.')}}đ</span></div>
                </div>
                @endforeach
            </div>
            <div class="totalTable flex justify-end font-semibold">Tạm tính: <span class="pl-2">{{number_format($total, 0, '', ',')}}đ</span></div>
        </div>
        <div class="delivery border-b py-2">
            <div class=""><h2 class="px-1 py-2 text-[18px] font-semibold">Thông tin vận chuyển</h2></div>
            <div class="grid grid-cols-5">
                <div class="col-span-2 text-center font-semibold"><span>Đơn vị giao hàng</span></div>
                <div class="col-span-2 text-center font-semibold"><span>Thời gian dự kiến</span></div>
                <div class="col-span-1 text-center font-semibold"><span>Phí</span></div>
            </div>
            <div class="grid grid-cols-5 mt-2 py-2">
                <div class="col-span-2 text-center"><span>Giao hàng tiết kiệm</span></div>
                <div class="col-span-2 text-center"><span>{{date('d/m/Y', strtotime("+3 days")) }} - {{date('d/m/Y', strtotime("+6 days"))}}</span></div>
                <div class="col-span-1 text-center"><span>{{number_format(30000, 0, '', '.')}}đ</span></div>
            </div>
        </div>
        <div class="total flex justify-end font-semibold">Tổng cộng:<span class="ml-2" id="totalPrice" data-price="{{$total}}">{{number_format($total+30000, 0, '', '.')}}</span>đ</div>
        <div class="payment">
            <div class=""><h2 class="px-1 py-2 text-[18px] font-semibold">Phương thức thanh toán</h2></div>
            <div class="option">
                <div class=""><span class="px-4 py-2 border border-primary-color">Thanh toán khi nhận hàng</span></div>
            </div>
        </div>
       
        <div class="flex justify-end">
            <button class="px-4 py-2 border border-primary-color hover:bg-primary-color hover:text-white" id="btnCheckout">Đặt hàng</button>
        </div>
    </div>

@endsection

@section('scripts')
    @vite('./resources/js/client/checkout.js')
@endsection

@section('title') <title>Thanh toán</title>@endsection