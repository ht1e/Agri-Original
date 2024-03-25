<div class="border-2 p-5">
    <h1 class="font-bold text-xl text-center">{{$title}}</h1>
    <form 
    action="{{empty($item)?route('handleAddProduct') :route('handleUpdateProduct', ['id' => $item->SP_Ma])}}" method="post" class="mt-10 text-left">
        @csrf
        <label for="" class="block my-10">
            Hình ảnh:
            <img 
                id="imgProduct"
                class="" 
                width="70"
                height="70"
                src="https://static.vecteezy.com/system/resources/previews/004/141/669/original/no-photo-or-blank-image-icon-loading-images-or-missing-image-mark-image-not-available-or-image-coming-soon-sign-simple-nature-silhouette-in-frame-isolated-illustration-vector.jpg" 
                alt="">
            <input type="file"  name="imgProduct" class="mt-2" onchange="displayImage(this);">
            
        </label>
        <label for="" class="block my-10">
            Tên sản phẩm:
            <input type="text" name="nameProduct" class="px-5 py-1 ml-2  bg-slate-200 rounded-md" @if(!empty($item)) value="{{$item->SP_Ten}} " @endif>
        </label>
        <label for="" class="block my-10">
            Mô tả:
            <textarea type="text" name="descriptionProduct" class="px-5 py-1 ml-2 w-[400px]  bg-slate-200 rounded-md leading-5 text-xs " @if(!empty($item)) value="{{'$item->DHO_MoTa'}} " @endif>@if(!empty($item)) {{$item->DHO_MoTa}}@endif</textarea>
        </label>
        <label for="" class="block my-10">
            Giá:
            <input type="number" name="priceProduct" class="px-5 py-1 ml-2  bg-slate-200 rounded-md" @if(!empty($item)) value="{{$item->SP_Gia}}" @endif>
        </label>
        <label for="" class="block my-10">
            Thương Hiệu:
            <input type="text" name="brand" class="px-5 py-1 ml-2  bg-slate-200 rounded-md" @if(!empty($item)) value="{{'$item->TH_Ten'}}" @endif>
        </label>

        <button type="submit" class="px-4 py-2 border-2 border-slate-400 rounded-md hover:bg-slate-200">{{$titleBtn}} sản phẩm</button>
    </form>
</div>