<div class="p-5 text-center border-2 rounded-md">
    <h1 class="text-xl font-bold">Thêm danh mục mới</h1>
    <form action="{{route('addCategory')}}" method="post" class="mt-10">
        @csrf
        <label for="" class="block">
            Tên danh mục:
            <input type="text" name="nameCategory" class="border-none rounded-md py-2 px-5 bg-slate-200 ml-2">
        </label>
        <button class="px-4 py-1 border-2 mt-5 border-slate-400 hover:bg-slate-200 rounded-md">Thêm</button>
    </form>
</div>