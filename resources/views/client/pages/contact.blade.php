@extends('client.layout.main')

@section('content')
<div class="relative">
    <img src="storage/Images/background/bg.jpg" class="brightness-50" alt="">

    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 bg-transparent text-white">
        <div class="py-2">
            <h1>Liên hệ với chúng tôi</h1>
        </div>
        <div class="border px-4 py-4 w-[350px] rounded-md drop-shadow-sm">
            <a href="" class="text-xl"><i class="fa-solid fa-phone-volume"></i></a>
            <div class="inline-block ml-2">
                <h1 class="text-xl uppercase font-bold">Phone</h1>
                <a>0779 880 788</a>
            </div>
        </div>
        <div class="border px-4 py-4 my-4 w-[350px] rounded-md ">
            <a href="" class="text-xl"><i class="fa-solid fa-envelope"></i></a>
            <div class="inline-block ml-2">
                <h1 class="text-xl uppercase font-bold">Email</h1>
                <a>newtechcropsciencevn@gmail.com</a>
            </div>
            
        </div>
        <div class="border px-4 py-4 my-4 w-[350px] rounded-md ">
            <a href="" class="text-xl"><i class="fa-brands fa-facebook"></i></a>
            <div class="inline-block ml-2">
                <h1 class="text-xl uppercase font-bold">FaceBook</h1>
                <a href="https://www.facebook.com/nongnghiepnewtech" class="">NewTech Việt Nam</a>
            </div>
            
        </div>
        <div class="border px-4 py-4 w-[350px] rounded-md ">
            <a href="" class="text-xl"><i class="fa-brands fa-tiktok"></i></a>
            <div class="inline-block ml-2">
                <h1 class="text-xl uppercase font-bold">TikTok</h1>
                <a href="https://www.tiktok.com/@newtech.vietnam">NewTech Viet Nam</a>
            </div>
            
        </div>

    </div>

</div>
    
@endsection