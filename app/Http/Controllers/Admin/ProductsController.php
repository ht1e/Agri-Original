<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SanPham;

class ProductsController extends Controller
{
    public function index() {
        $items = SanPham::paginate(10);

        return view('Admin.page.Product.mainProduct', compact('items'));
    }

    public function addProduct() {
        return view('Admin.page.Product.addProduct');
    }

    public function handleAddProduct(Request $request) {

       dd($request);
        
    }

    public function handleUpdateProduct(Request $request, $id) {
        dd($request, $id);
        return redirect('/admin/product');
    }
    public function getUpdateProduct($id) {
        
        $item = SanPham::where('sp_ma', $id)
        ->join('danhmuc', 'sanpham.sp_madm', '=', 'danhmuc.dm_ma')
        ->first();

        return view('Admin.page.Product.updateProduct', compact('item'));    
    }

    public function handleDeleteProduct(Request $request, $id) {
        //dd($id);

        return redirect('/admin/product');
    }

}
