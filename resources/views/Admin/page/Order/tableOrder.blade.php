<div class="w-full">
    <table class="w-full">
        <thead class="border-b-2 leading-10">
            <th>Mã đơn hàng</th>
            <th>Mã người dùng</th>
            <th>Thời Gian</th>
            <th>Trạng Thái</th>
            <th>Ghi Chú</th>
            <th>Hành động</th>
        </thead>
        <tbody class="text-center">
            @foreach($items as $key => $item) 
                <tr class="leading-10 border-b">
                    <td class="border-r-2 py-2">{{$item->DH_Ma}}</td>
                    <td class="border-r-2 py-2">{{$item->DH_MaND}}</td>
                    <td class="border-r-2 py-2">{{$item->DH_ThoiGian}}</td>
                    <td class="border-r-2 py-2">
                        @switch($item->DH_MaTTDH)
                            @case(1)
                                <p class="px-4 rounded-xl border-2 inline-block bg-cyan-600">{{$item->TTDH_Ten}}</p>
                                @break
                            @case(2)
                                <p class="px-4 rounded-xl border-2 inline-block bg-blue-300">{{$item->TTDH_Ten}}</p>
                                @break
                            @case(4)
                                <p class="px-4 rounded-xl border-2 inline-block bg-green-300">{{$item->TTDH_Ten}}</p>
                                @break
                            @case(3)
                                <p class="px-4 rounded-xl border-2 inline-block bg-red-500">{{$item->TTDH_Ten}}</p>
                                @break
                        @endswitch
                    </td>
                    <td class="border-r-2 py-2 text-xs">{{$item->DH_GhiChu}}</td>
                    <td>
                        @if($item->DH_MaTTDH == 1)
                            <form action="{{route('acceptedOrder')}}" method="POST">
                                @csrf
                                <input type="hidden" name="idOrder" value="{{$item->DH_Ma}}">
                                <input type="hidden" name="typeOrder" value="4">
                                <button class="px-2 py-1 text-xs border-2 rounded-xl bg-green-300">Chấp nhận</button>
                            </form>
                        @endif
                            <a class="px-2 py-1 text-xs border-2 rounded-xl bg-yellow-300 " href="{{route('orderDetails', ['id' => $item->DH_Ma])}}">Xem chi tiết</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>