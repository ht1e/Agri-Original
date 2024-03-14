<div class="cardProduct w-full h-[350px] bg-slate-300 rounded-md border relative">
        <div class="h-[130px]">
            <a href="{{route('productDetails', ['id' => $item->SP_Ma])}}">
                <img class="h-full w-full  rounded-t-md" src="https://www.hoptri.com/media/k2/items/cache/63955aa9869cf7707ada1662dbfb31e2_XL.jpg" alt="">
            </a>
        </div>
        <div class="infor py-2 px-2">
            <h1 class="leading-7 h[50px] overflow-hidden">{{$item->SP_Ten}}</h1>
            <h2 class="leading-8 ">{{number_format($item->SP_Gia, 0, '', ',')}}₫</h2>
            <p class="text-xs h-[50px] lowercase overflow-hidden">{{$item->SP_MoTa}}</p>
        </div>
        <div class="absolute bottom-2 ">
            <div class="px-2 flex flex-auto">
                <a href="{{route('productDetails', ['id' => $item->SP_Ma])}}" class="text-[12px] px-2 py-1 border bg-[#00cc00] rounded-[10%] hover:scale-105 hover:rotate-3 ">Mua ngay</a>
                <button class="btnAddToCart text-[12px] px-2 py-1 border bg-[#00cc00] rounded-[10%] hover:scale-105 hover:rotate-3 ml-[60px]" data-key="{{$item->SP_Ma}}">Thêm vào giỏ</button>
            </div>
        </div>  
</div>