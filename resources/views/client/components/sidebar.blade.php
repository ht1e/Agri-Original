<div class="w-full mb-10 border">
    <ul class="flex">
        @foreach($categories as $key => $category) 
            <li class="px-4 py-2 mr-5 text-center">
                <a href="{{route('getCategory', ['id' => $category->DM_Ma])}}" class="group">
                    <img class="h-[50px] w-[50px] rounded-full" src="https://www.hoptri.com/media/k2/items/cache/63955aa9869cf7707ada1662dbfb31e2_XL.jpg" alt="">
                    <span class="py-2 block group-hover:text-[#009b49] text-xs w-[60px]">{{$category->DM_Ten}}</span>
                </a>
            </li>
        @endforeach
    </ul>
    <div class="mt-2 p-2 flex justify-center">
        <form action="{{route('search')}}" class="w-[300px] relative leading-10 " method="post">
            @csrf
            @if(!empty($keysearch))
                <input class="w-full border focus:outline-none focus:border-[#009b49] px-4 rounded-lg" type="text" name="textSearch" id="" value="{{$keysearch}}">
            @else
                <input class="w-full border focus:outline-none focus:border-[#009b49] px-4 rounded-lg" type="text" name="textSearch" id="">
            @endif
            <button id="btnSearch" class="absolute top-0 -right-0 border-[#009b49] hover:scale-90 rounded-lg">
                <i class="fa-solid fa-magnifying-glass px-4 py-1"></i>
            </button>
            
        </form>
    </div>
</div>