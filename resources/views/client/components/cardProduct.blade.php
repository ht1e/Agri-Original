<div class="cardProduct w-full  bg-slate-200 rounded-md border text-center p-2">
        <div class="h-[200px]">
            <a href="{{route('productDetails', ['id' => $item->SP_Ma])}}">
                <img class="h-full w-full  rounded-t-md" src="https://www.hoptri.com/media/k2/items/cache/63955aa9869cf7707ada1662dbfb31e2_XL.jpg" alt="">
            </a>
        </div>
        <div class="infor py-2 px-2">
            <h1 class="h-[50px]  overflow-hidden">{{$item->SP_Ten}}</h1>
            <p class="text-xs h-[50px] lowercase overflow-hidden">{{$item->SP_MoTa}}</p>
            <h2 class="">{{number_format($item->SP_Gia, 0, '', ',')}}₫</h2>
        </div>
        <div class="">
                <a href="{{route('productDetails', ['id' => $item->SP_Ma])}}" class="text-[12px] px-2 py-1 border bg-primary-color rounded-[10%] hover:scale-105 hover:rotate-3 text-white">Xem chi tiết</a>
        </div>  
</div>