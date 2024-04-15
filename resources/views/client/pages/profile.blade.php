@extends('client.layout.main')
@section('content')
<div class="px-2 py-5 grid grid-cols-5 gap-4">
    <div class="sidebar col-span-1">
        <aside>
            <ul>
                <li class="px-4 py-2 my-2 leading-10 border cursor-pointer text-center text-white bg-primary-color" id="information">Thông tin cá nhân</li>
                <li class="px-4 py-2 leading-10 border cursor-pointer text-center" id="orders">Thông tin đơn hàng</li>
            </ul>
        </aside>
    </div>
    <div class="col-span-4 p-2">
        <div class="hidden" id="inforOrder">
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
                <div class="">{{date('d-m-Y', strtotime($item->DH_ThoiGian))}}</div>
                <div class="">{{number_format($item->DH_TongGiaTri, 0, '', '.')}}đ</div>
                <div class="">{{$item->TTDH_Ten}}</div>
                <div class="">
                    <a href="{{route('getOrder', ['id' => $item->DH_Ma])}}" class="px-2 py-1 bg-blue-400 text-xs">Xem chi tiết</a>
                </div>
            </div>
            @endforeach
        </div>
        <div class="" id="infor">
            <h1 class="text-xl font-bold text-primary-color">Thông tin cá nhân</h1>
            <div class="" id="containerBase">
                <div class="py-5 text-xl inline-block">
                    <label for="">
                        Họ và đệm: <span class="text-slate-400 px-2">{{Auth::user()->ND_Ho}}</span>
                    </label>
                </div>
                <div class=" py-5 text-xl inline-block ml-20">
                    <label for="">
                        Tên: <span class="text-slate-400 px-2">{{Auth::user()->ND_Ten}}</span>
                    </label>
                </div>
                <div class=" py-5 text-xl">
                    <label for="">
                        Ngày sinh: <span class="text-slate-400 px-2">{{Auth::user()->ND_NgaySinh}}</span>
                    </label>
                </div>
                <div class=" py-5 text-xl">
                    <label for="">
                        Số điện thoại: <span class="text-slate-400 px-2">{{Auth::user()->ND_SDT}}</span>
                    </label>
                </div>
                <div class=" py-5 text-xl">
                    <label for="">
                        Email: <span class="text-slate-400 px-2">{{Auth::user()->ND_email}}</span>
                    </label>
                </div>
                <div class=" py-5 text-xl">
                    <label for="">
                        Mật khẩu: <span class="text-slate-400 px-2">**********</span>
                    </label>
                </div>
            </div>

            <div class="hidden" id="containerChange">
                <form action="{{route('updateProfile')}}" method="POST" id="formUpdate">
                    @csrf
                    <div class=" py-5 text-xl inline-block">
                        <label for="">
                            Họ và đệm: <input class="border py-2 rounded-md text-slate-400 px-2" value="{{Auth::user()->ND_Ho}}" name="firstName" id="firstName">
                        </label>
                    </div>
                    <div class=" py-5 text-xl inline-block ml-20">
                        <label for="">
                            Tên: <input class="border py-2 rounded-md text-slate-400 px-2" value="{{Auth::user()->ND_Ten}}" name="lastName" id="lastName">
                        </label>
                    </div>
                    <div class=" py-5 text-xl">
                        <label for="">
                            Ngày sinh: <input class="border py-2 rounded-md text-slate-400 px-2" value="{{Auth::user()->ND_NgaySinh}}" type="date" id="birthday" name="birthday">
                        </label>
                    </div>
                    <div class=" py-5 text-xl">
                        <label for="">
                            Số điện thoại: <span class="text-slate-400 px-2">{{Auth::user()->ND_SDT}}</span>
                        </label>
                    </div>
                    <div class=" py-5 text-xl">
                        <label for="">
                            Email: <span class="text-slate-400 px-2">{{Auth::user()->ND_email}}</span>
                        </label>
                    </div>
                    <div class=" py-5 text-xl">
                        <label for="">
                            Mật khẩu hiện tại: <input class="border py-2 rounded-md text-slate-400 px-2" type="password" id="password" name="password">
                        </label>
                    </div>
                    <div class=" py-5 text-xl">
                        <label for="">
                            Nhập lại mật khẩu: <input class="border py-2 rounded-md text-slate-400 px-2" type="password" id="passwordCorrect" name="passwordCorrect">
                        </label>
                    </div>
                </form>
            </div>
            <div class="mt-5">
                <button class="px-4 py-2 border border-primary-color text-primary-color " id="btnShowChange">Thay đổi</button>
                <button class="px-4 py-2 border border-primary-color text-primary-color ml-5 hidden" id="btnSave">Lưu lại</button>
            </div>
        </div>
        
    </div>

</div>
@endsection

@section('scripts')
    @vite('./resources/js/client/profile.js')
@endsection
