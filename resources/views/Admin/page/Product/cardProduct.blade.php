@if(!empty($item))
    <div class=" shrink col-span-1 h-[380px]  border rounded-lg relative">
        <img class="w-full h-[150px] rounded-t-lg" 
        src="https://th.bing.com/th/id/OIP.e9GMiEwOZA2neV4JBfJjwQHaHa?rs=1&pid=ImgDetMain" 
        alt="">
        <div class="p-2">
            <h1 class="h-[65px]">{{$item->SP_Ten}}</h1>
            <p class="text-xs h-[60px] overflow-hidden lowercase mt-2">{{$item->SP_MoTa}}</p>
            <h3 class="mt-2">{{number_format($item->SP_Gia, 0, '', '.')}}đ</h3>

        </div>
        <div class="p-2 flex justify-between absolute bottom-0">  
            <form action="{{route('getUpdateProduct', ['id' => $item->SP_Ma])}}" method="get">
                @csrf
                <input type="hidden" name="idProduct" value="{{$item}}">
                <button class="px-2 py-1 mt-6 border-2 border-slate-400 rounded-md hover:bg-slate-200 text-xs">Chỉnh Sửa</button>
            </form>
            <form class="ml-5" action="{{route('handleDeleteProduct', ['id' => $item->SP_Ma])}}" method="post">
                @csrf
                <input type="hidden" name="idProduct" value="{{$item->SP_Ma}}">
                <button class="px-2 py-1 mt-6 border-2 border-slate-400 rounded-md hover:bg-slate-200 text-xs">Xóa</button>
            </form>
        </div>
    </div>
@endif