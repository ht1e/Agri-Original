<div class="border-r border-primary-color p-2">
    <ul>
        <li class="leading-10 border-b">
            <i class="fa-solid fa-bars pl-1"></i>
        </li>
        @foreach($categories as $key => $category) 
        <li class=" border-b hover:border-primary-color">
            <a href="{{route('getCategory', ['id' => $category->DM_Ma])}}" class="bg-white block leading-10 text-[14px] pl-1">{{$category->DM_Ten}}</a>
        </li>
        @endforeach
    </ul>
</div>