@extends('Admin.layout.main')

@section('content')
    <div class="w-90% h-90% mx-auto mt-5 px-2">
        @include('Admin.page.Product.detailsProduct', ['title' =>'Thêm sản phẩm mới', 'titleBtn' => 'Thêm'])
    </div>
@endsection

@section('scripts')
    @vite('./resources/js/Admin/Product/Product.js')
@endsection