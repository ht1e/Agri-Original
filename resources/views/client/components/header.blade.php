<div class="w-[70%] mx-auto h-full grid grid-cols-5 gap-3">
    <div class="logo col-span-1">
        <a href="{{route('home')}}" class="w-full h-full">
            <img class="w-[60%] h-[90%]" src="https://newtechvietnam.com/wp-content/uploads/2024/01/LOGO-1.png" alt="">
        </a>
    </div>
    <div class="container col-span-4 grid grid-rows-2">
        <div class="account row-span-1 text-right px-5">
            <ul class="w-full float-right">
                <li class="inline mx-2 ">
                    @if(Auth::check())
                    <a href="{{route('getProfile')}}" class=" text-[10px] group">
                        <span class=" text-primary-color opacity-45 group-hover:opacity-100">{{Auth::user()->ND_Ten}}</span>
                        <i class="fa-solid fa-user py-2 text-xl text-primary-color opacity-45 group-hover:opacity-100"></i>
                    </a>
                    @else
                    <a href="{{route('login')}}" class=" text-[10px] group">
                        <span class="text-primary-color opacity-45 group-hover:opacity-100">Đăng nhập</span>
                        <i class="fa-solid fa-user py-2 text-xl text-primary-color opacity-45 group-hover:opacity-100"></i>
                    </a>
                    @endif
                </li>
                <li class="inline mx-2">
                    @if(Auth::check())
                    <a href="{{route('getCart')}}" class="">
                        <i class="fa-solid fa-cart-shopping py-2 text-xl text-primary-color opacity-45 hover:opacity-100"></i>
                    </a>
                    @else 
                    <a href="{{route('login')}}" class="">
                        <i class="fa-solid fa-cart-shopping py-2 text-xl text-primary-color opacity-45 hover:opacity-100"></i>
                    </a>
                    @endif
                </li>
                @if(Auth::check())
                <li class="inline mx-2">
                    <form class="inline-block" action="{{route('logout')}}" method="post">
                        @csrf
                        <button class="text-primary-color">
                            <i class="fa-solid fa-right-from-bracket py-2 text-xl  opacity-45 hover:opacity-100"></i><span class="text-[10px] ml-1">Đăng xuất</span>
                        </button>
                    </form> 
                </li>
                @endif
                
            </ul>
        </div>
        <div class="nav row-span-1">
            <ul class="float-left w-full">
                <li class="inline mx-8"><a href="{{route('home')}}" class="px-2 py-1 font-semibold text-slate-500 hover:text-slate-900 hover:scale-125">Trang Chủ</a></li>
                <li class="inline mx-8"><a href="{{route('mainProduct')}}" class="px-2 py-1 font-semibold text-slate-500 hover:text-slate-900 hover:scale-125">Sản Phẩm</a></li>
                {{-- <li class="inline mx-8"><a href="" class="px-2 py-1 font-semibold text-slate-500 hover:text-slate-900 hover:scale-125">Giới Thiệu</a></li> --}}
                <li class="inline mx-8"><a href="{{route('getContact')}}" class="px-2 py-1 font-semibold text-slate-500 hover:text-slate-900 hover:scale-125">Liên Hệ</a></li>
                <li class="inline mx-8"><a href="" class="px-2 py-1 font-semibold text-slate-500 hover:text-slate-900 hover:scale-125">Tin Tức</a></li>
            </ul>
        </div>
    </div>
</div>