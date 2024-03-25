@extends('client.layout.main')

@section('content')
    <div class="w-full p-2 "> 
        <div class="sidebarContainer ">
            @if(!empty($keysearch))
                @include('client.components.sidebar', ['categories' => $categories, 'keysearch' => $keysearch])
            @else
                @include('client.components.sidebarProduct', ['categories' => $categories])
            @endif
        </div>
        <div class="p-2 filterContainer h-auto">
            <form action="{{route('filterProduct')}}" method="post">
                @csrf
                <ul>
                    <li></li>
                    <li class="text-xs leading-8">
                        @if(!empty($sort))
                        <select name="sort" id="sort" value="{{$sort}}">
                            <option disabled > -- select an option -- </option>
                            <option value="1">Sắp xếp tăng dần</option>
                            <option value="2">Sắp xếp giảm dần</option>
                        </select>
                        @else
                        <select name="sort" id="sort">
                            <option disabled selected value> -- select an option -- </option>
                            <option value="1">Sắp xếp tăng dần</option>
                            <option value="2">Sắp xếp giảm dần</option>
                        </select>
                        @endif
                    </li>
                    <li class="text-xs leading-8">

                        @if(!empty($inputPrice))
                        <label for="">
                            Giá: 
                            <input name="inputPrice" id="inputPrice" type="range" value="{{$inputPrice}}" min="0" max="1000000" >
                            {{-- oninput="this.nextElementSibling.value = this.value" --}}
                            <output id="output">{{number_format($inputPrice, 0, '', '.')}}</output>
                        </label>
                        @else
                        <label for="">
                            Giá: 
                            <input name="inputPrice" id="inputPrice" type="range" value="0" min="0" max="1000000" >
                            {{-- oninput="this.nextElementSibling.value = this.value" --}}
                            <output id="output">0</output>
                        </label>

                        @endif
                    </li>
                </ul>
                <button type="submit" class="px-2 py-1 text-xs bg-slate-300"><span>Lọc</span><i class="fa-solid fa-filter"></i></button>
            </form>
            
        </div>
        <div class=" p-2 grid grid-cols-4 gap-4">
            @foreach($data as $key => $item)
                <div class="col-span-1">
                    @include('client.components.cardProduct', ['item' => $item])
                </div>
            @endforeach
        </div>
        {{$data->links()}}
    </div>

@endsection

@section('scripts')
    @vite('./resources/js/client/product.js')
@endsection

@section('title') <title>Sản phẩm</title>@endsection