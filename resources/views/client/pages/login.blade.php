<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite('./resources/css/app.css')
</head>
<body>
    <header class="w-full h-auto">
        <div class="w-[70%] mx-auto grid grid-cols-5 gap-3">
            <div class="logo col-span-1">
                <a href="{{route('home')}}" class="w-full ">
                    <img class="w-[60%] h-[90%]" src="https://newtechvietnam.com/wp-content/uploads/2024/01/LOGO-1.png" alt="">
                </a>
            </div>
            <div class="container col-span-4 grid grid-rows-2 py-5">
                {{-- <div class="account row-span-1 text-right px-5">
                    <ul class="w-full float-right">
                        <li class="inline mx-2">
                            <a href="" class="">
                                <i class="fa-solid fa-user py-2 text-xl text-[#37903B] opacity-45 hover:opacity-100"></i>
                            </a>
                        </li>
                        <li class="inline mx-2">
                            <a href="" class="">
                                <i class="fa-solid fa-cart-shopping py-2 text-xl text-[#37903B] opacity-45 hover:opacity-100"></i>
                            </a>
                        </li>
                    </ul>
                </div> --}}
                <div class="nav row-span-1">
                    <ul class="float-left w-full">
                        <li class="inline mx-8"><a href="{{route('home')}}" class="px-2 py-1 font-semibold text-slate-500 hover:text-slate-900 hover:scale-125">Trang Chủ</a></li>
                        <li class="inline mx-8"><a href="{{route('mainProduct')}}" class="px-2 py-1 font-semibold text-slate-500 hover:text-slate-900 hover:scale-125">Sản Phẩm</a></li>
                        <li class="inline mx-8"><a href="" class="px-2 py-1 font-semibold text-slate-500 hover:text-slate-900 hover:scale-125">Giới Thiệu</a></li>
                        <li class="inline mx-8"><a href="" class="px-2 py-1 font-semibold text-slate-500 hover:text-slate-900 hover:scale-125">Liên Hệ</a></li>
                        <li class="inline mx-8"><a href="" class="px-2 py-1 font-semibold text-slate-500 hover:text-slate-900 hover:scale-125">Tin tức</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </header>
    <main class="h-screen w-full">
        <div class="w-[50%]  mx-auto bg-slate-50 mt-5">  
            <div class="p-4">
                <h1 class="w-full text-center text-xl font-bold">
                    ĐĂNG NHẬP
                </h1>
            </div> 
            <div class="p-4">
                <form action="{{route('postLogin')}}" method="POST">
                    @csrf
                    <label for="" class="py-4 my-2 relative block w-[40%]">
                       <span class="absolute top-0 left-0 text-xs">Email:</span>
                        <input class="px-4 py-1 rounded-md outline-none border focus:border-primary-color w-full" type="text" name="email">
                        @if(session()->has('invalid-email'))<span class="text-xs text-red-500">{{session()->get('invalid-email')}}</span> @endif
                        @error('email')<span class="text-xs text-red-500">{{$message}}</span> @enderror
                    </label>
                    <label for="" class="py-4 my-2 relative block w-[40%]">
                       <span class="absolute top-0 left-0 text-xs">Mật khẩu:</span>
                        <input class="px-4 py-1 rounded-md outline-none border focus:border-primary-color w-full" type="password" name="password">
                        @if(session()->has('incorrect-password'))<span class="text-xs text-red-500">{{session()->get('incorrect-password')}}</span> @endif
                        @error('password')<span class="text-xs text-red-500">{{$message}}</span> @enderror
                    </label>
                    <div class=" flex justify-between items-center">
                        <button type="submit" class="px-4 py-2 rounded-md bg-primary-color text-white">Đăng Nhập</button>
                        <p class="text-xs">Bạn chưa có tài khoản?<a class="text-primary-color" href="{{route('register')}}">Đăng ký ngay.</a></p>
                    </div>
                    
                </form>
            </div>
            
        </div>
    </main>
    
</body>
</html>