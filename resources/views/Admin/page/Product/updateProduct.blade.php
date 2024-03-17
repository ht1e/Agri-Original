@extends('Admin.layout.main')

@section('content')
    <div class="w-90% h-90% mx-auto mt-5">
       @include('Admin.page.Product.detailsProduct', ['item' => $item, 'title' => 'Sửa thông tin sản phẩm', 'titleBtn' => 'Sửa'])
    </div>
    

@endsection

@section('scripts')
    @vite('./resources/js/Admin/Product/Product.js')
@endsection