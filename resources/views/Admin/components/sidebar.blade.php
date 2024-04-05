<div class="h-full w-full ">
    <a href="{{route('home')}}"><img class="h-[50px] m-auto" src="https://newtechvietnam.com/wp-content/uploads/2024/01/LOGO-1.png" alt=""></a>
    <div class="container mt-10">
        <ul class="">
            <li class="px-2 py-3 ml-2">
                <a href="{{route('admin')}}" class="block text-[15px] py-2 border-b-2 hover:text-red-400">Dasboard</a>
            </li>
            <li class="px-2 py-3 ml-2">
                <a class="block text-[15px] py-2 border-b-2 hover:text-red-400" href="#">Danh Mục</a>
                <ul class="mt-2 ml-2">
                    <li class="py-2 hover:text-cyan-600">
                        <a href="{{route('addCategory')}}" class="text-[12px]">Thêm danh mục mới</a>
                    </li>
                </ul>
            </li>
            <li class="px-2 py-3 ml-2">
                <a href="{{route('adminMainProduct')}}" class="block text-[15px] py-2 border-b-2 hover:text-red-400">Sản Phẩm</a>
                <ul class="mt-2 ml-2">
                    <li class="py-2 hover:text-cyan-600">
                        <a href="{{route('addProduct')}}" class="text-[12px]">Thêm sản phẩm mới</a>
                    </li>
                </ul>
            </li>
            <li class="px-2 py-3 ml-2">
                <a href="{{route('mainOrder')}}" class="block text-[15px] py-2 border-b-2 hover:text-red-400">Đơn Hàng</a>
                <ul class="mt-2 ml-2">
                    <li class="py-2 hover:text-cyan-600">
                        <a href="{{route('ordered')}}" class="text-[12px]">Đơn hàng đã được đặt</a>
                    </li>
                    <li class="py-2 hover:text-cyan-600">
                        <a href="{{route('acceptOrder')}}" class="text-[12px]">Đơn hàng đã chấp nhận</a>
                    </li>
                    <li class="py-2 hover:text-cyan-600">
                        <a href="{{route('rejectOrder')}}" class="text-[12px]">Đơn hàng đã hủy</a>
                    </li>
                    <li class="py-2 hover:text-cyan-600">
                        <a href="{{route('successOrder')}}" class="text-[12px]">Đơn hàng đã thành công</a>
                    </li>
                </ul>
            </li>
            <li class="px-2 py-3 ml-2">
                <a href="{{route('mainUsers')}}" class="block text-[15px] py-2 border-b-2 hover:text-red-400">Người Dùng</a>
            </li>
            <li class="px-2 py-3 ml-2">
                <a class="block text-[15px] py-2 border-b-2 hover:text-red-400" href="{{route('getImport')}}">Hóa Đơn Nhập</a>
                <ul class="mt-2 ml-2">
                    <li class="py-2 hover:text-cyan-600">
                        <a href="{{route('getAddImport')}}" class="text-[12px]">Tạo mới hóa đơn nhập</a>
                    </li>
                </ul>
            </li>
            <li class="px-2 py-3 ml-2">
                <form action="{{route('logout')}}" method="POST">
                    @csrf
                    <button class="block text-[15px] py-2 border-b-2 text-white bg-red-400 px-2" >Đăng xuất</button>
                </form>
                
            </li>
        </ul>
    </div>
</div>