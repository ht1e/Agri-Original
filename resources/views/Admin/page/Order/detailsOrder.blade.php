@extends('Admin.layout.main')

@section('content')
    <div class="w-90% h-90% mx-auto mt-5">
        <div class="statusOrder">
            <h1 class="text-center block text-xl font-bold">Chi Tiết Đơn Hàng</h1>
            <h2 class="block my-5">Mã đơn hàng: {{$id}}</h2>
            <div class="statusBlock">
                <div class="statusName grid grid-cols-3">
                    <div class="text-center">Đã đặt</div>
                    <div class="text-center">Đã chấp nhận</div>
                    <div class="text-center">Đã hoàn thành</div>
                </div>
                <div class="statusLine h-0 border border-slate-300 mt-10 relative">
                    @switch($status->TTDH_Ma)
                        @case(1)
                            <div class="line absolute h-full w-[17%] top-0 left-0 border-2 border-green-300  -translate-y-0.5"></div>
                            @break
                        @case(4)
                            <div class="line absolute h-full w-[50%] top-0 left-0 border-2 border-green-300  -translate-y-0.5"></div>
                            @break
                        @case(2)
                            <div class="line absolute h-full w-[100%] top-0 left-0 border-2 border-green-300  -translate-y-0.5"></div>
                            @break
                        @case(3)
                            <div class="line absolute h-full w-[100%] top-0 left-0 border-2 border-red-500 -translate-y-0.5"></div>
                            @break
                    @endswitch
                    
                </div>
            </div>
           
        </div>
        <div class="inforOrder w-full mt-10">
            <table class="w-full leading-10 border-b-2">
                <thead>
                    <th>Sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Giá</th>
                    <th>Tổng</th>
                </thead>
                <tbody class="text-center">
                    @foreach($details as $key => $item)
                        <tr class="py-2">
                            <td class="text-left"><img src="{{$item->SP_HinhAnh}}" class="w-[80px] h-[50px] inline-block" alt=""><span>{{$item->SP_Ten}}</span></td>
                            <td>{{$item->CTDH_SoLuong}}</td>
                            <td>{{number_format($item->CTDH_Gia, 0, '', '.')}}đ</td>
                            <td>{{number_format($item->CTDH_Gia*$item->CTDH_SoLuong, 0, '', '.')}}đ</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-10 text-right">
                <h2 class="text-xl">Tổng: {{number_format($total, 0, '', '.')}}đ</h2>
            </div>
        </div>
    </div>
@endsection
