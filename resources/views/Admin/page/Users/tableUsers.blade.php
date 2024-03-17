<div class="w-full">
    <table class="w-full">
        <thead class="border-b-2 leading-10">
            <th>Họ</th>
            <th>Tên</th>
            <th>Địa chỉ email</th>
            <th>Số điện thoại</th>
            <th>Vai trò</th>
        </thead>
        <tbody class="text-center">
            @foreach($listuser as $key => $item) 
                <tr class="leading-10">
                    <td class="border-r-2 py-2">{{$item->ND_Ho}}</td>
                    <td class="border-r-2 py-2">{{$item->ND_Ten}}</td>
                    <td class="border-r-2 py-2">
                       <p class="px-4  inline-block">{{$item->ND_Email}}</p>
                    </td>
                    <td class="border-r-2 py-2 ">{{$item->ND_SDT}}</td>
                    <td>
                        <form action="" method="POST">
                            <select name="roleUser" id="" class="border-2 px-1 py-1 rounded-md bg-slate-200">
                                <option value="1" @if($item->ND_MaVT == 1) selected ="selected" @endif>Người dùng</option>
                                <option value="2" @if($item->ND_MaVT == 2) selected ="selected" @endif>Quản trị</option>
                            </select>
                            <button class="px-2 py-1 text-xs border-2 rounded-md ml-2 border-slate-400">Thay đổi</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>