@extends('client.layout.main')

@section('content')
    <div class="w-90% h-90% mx-auto mt-5">
        <div class="statusOrder px-2 py-4 border-2 rounded-md my-4">
            <h1 class="text-center block text-xl font-bold">Chi Tiết Đơn Hàng</h1>
            <a href="{{route('getProfile')}}"><i class="fa-solid fa-circle-arrow-left text-xl text-primary-color mr-2"></i>Trở về tài khoản</a>
            <h2 class="block my-5">Mã đơn hàng: {{$id}}</h2>
            {{-- <h2>Ngày đặt: <span></span></h2>
            <h2>Ngày dự kiến nhận hàng: <span></span></h2> --}}
            <div class="statusBlock">
                <div class="statusName grid grid-cols-4">
                    <div class="text-center">Đã đặt</div>
                    <div class="text-center">Đã chấp nhận</div>
                    <div class="text-center">Đã hoàn thành</div>
                    <div class="text-center">Đã hủy</div>
                </div>
                <div class="statusLine h-0 border border-slate-300 mt-10 relative">
                    @switch($status->DH_MaTTDH)
                        @case(1)
                            <div class="line absolute h-full w-[13%] top-0 left-0 border-2 border-green-300  -translate-y-0.5"></div> 
                            @break
                        @case(4)
                            <div class="line absolute h-full w-[38%] top-0 left-0 border-2 border-green-300  -translate-y-0.5"></div>
                            @break
                        @case(2)
                            <div class="line absolute h-full w-[63%] top-0 left-0 border-2 border-green-300  -translate-y-0.5"></div>
                            @break
                        @case(3)
                            <div class="line absolute h-full w-[100%] top-0 left-0 border-2 border-red-500 -translate-y-0.5"></div>
                            @break
                    @endswitch
                    
                </div>
            </div>
           
        </div>
        <div class="inforOrder w-full px-2 py-4 border-2 rounded-md my-4">
            <table class="w-full leading-10 border-b-2">
                <thead>
                    <th>Sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Giá</th>
                    <th>Tổng</th>
                </thead>
                <tbody class="text-center">
                    @foreach($details as $key => $item)
                        <tr class="leading-[80px] border-b">
                            <td>
                                <a class="flex justify-left items-center" href="{{route('productDetails', ['id' => $item->SP_Ma])}}">
                                    <img src="{{$item->SP_HinhAnh}}" class="w-[60px] h-[30px] mr-8" alt="">
                                    <span>{{$item->SP_Ten}}</span>
                                </a>
                            </td>
                            <td>{{$item->CTDH_SoLuong}}</td>
                            <td>{{number_format($item->CTDH_Gia, 0, '', '.')}}đ</td>
                            <td>{{number_format($item->CTDH_Gia*$item->CTDH_SoLuong, 0, '', '.')}}đ</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-10 text-right">
                <h2 class="text-xl text-red-400">Tổng: {{number_format($status->DH_TongGiaTri, 0, '', '.')}}đ</h2>
                @if($status->MaTTDH == 1)
                <form action="{{route('cancelOrder', ['id' => $id])}}" method="post">
                    @csrf
                    <input type="hidden" value="{{$id}}" name="idCancel">
                    <button class=" mt-2 py-2 px-4 border bg-red-500 text-white" id="btnCancel">Hủy đơn hàng</button>
                </form>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('title') <title>Chi tiết đơn hàng</title> @endsection
