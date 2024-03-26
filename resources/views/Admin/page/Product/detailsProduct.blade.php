<div class="border-2 p-5">
    <h1 class="font-bold text-xl text-center">{{$title}}</h1>
    <form 
    action="{{empty($item)?route('handleAddProduct') :route('handleUpdateProduct', ['id' => $item->SP_Ma])}}" method="post" class="mt-10 text-left" enctype="multipart/form-data"> 
        @csrf
        @if(!empty($item)) <input type="hidden" name="idProduct" value="{{$item->SP_Ma}}"> @endif
        <label for="" class="block my-10">
            Hình ảnh:
            <img 
                id="imgProduct"
                class="" 
                width="70"
                height="70"
                @if(!empty($item))
                    src="{{$item->SP_HinhAnh? $item->SP_HinhAnh : '/storage/Images/Products/default_product.png'}}"
                @else
                    src="https://static.vecteezy.com/system/resources/previews/004/141/669/original/no-photo-or-blank-image-icon-loading-images-or-missing-image-mark-image-not-available-or-image-coming-soon-sign-simple-nature-silhouette-in-frame-isolated-illustration-vector.jpg" 
                @endif
                alt="">
            <input type="file"  name="imgProduct" class="mt-2" onchange="displayImage(this);">
            
        </label>
        <label for="" class="block my-10">
            Tên sản phẩm:
            <input type="text" name="nameProduct" class="px-5 py-1 ml-2  bg-slate-200 rounded-md" @if(!empty($item)) value="{{$item->SP_Ten}} " @endif>
        </label>
        <label for="" class="block my-10">
            Mô tả:
            <textarea type="text" name="descriptionProduct" class="px-5 py-1 ml-2 w-[400px]  bg-slate-200 rounded-md leading-5 text-xs ">@if(!empty($item)) {{$item->SP_MoTa}}@endif</textarea>
        </label>
        <label for="" class="block my-10">
            Giá:
            <input type="number" name="priceProduct" class="px-5 py-1 ml-2  bg-slate-200 rounded-md" @if(!empty($item)) value="{{$item->SP_Gia}}" @endif>
        </label>
        <label for="" class="block my-10">
            Danh Mục:
            <select type="text" name="category" class="px-5 py-1 ml-2  bg-slate-200 rounded-md" @if(!empty($item)) value="{{'$item->TH_Ten'}}" @endif>
                @foreach ($categories as $category)
                <option value="{{$category->DM_Ma}}">{{$category->DM_Ten}}</option>
                @endforeach
            </select>
        </label>

        <button type="submit" class="px-4 py-2 border-2 border-slate-400 rounded-md hover:bg-slate-200">{{$titleBtn}} sản phẩm</button>
    </form>
</div>