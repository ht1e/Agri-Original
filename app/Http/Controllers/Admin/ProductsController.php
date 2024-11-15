<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Models\SanPham;
use App\Models\DanhMuc;

class ProductsController extends Controller
{
    public function index() {
        $items = SanPham::paginate(10);

        $SQLTotalAvaiable = "select sanpham.SP_Ma, 
        sum(chitiethoadonnhap.CTHDN_Soluong), 
        SUM(IFNULL(chitietdonhang.CTDH_SoLuong, 0)), 
        IFNULL(sum(chitiethoadonnhap.CTHDN_Soluong) - IFNULL(sum(chitietdonhang.CTDH_SoLuong), 0), 0) as tonkho
        from chitiethoadonnhap, sanpham
        LEFT JOIN chitietdonhang
        on chitietdonhang.CTDH_MaSP = sanpham.SP_Ma 
        where chitiethoadonnhap.CTHDN_MaSP = sanpham.SP_Ma
        GROUP by sanpham.SP_Ma
        ORDER BY sanpham.SP_Ma";

        $totalAvaiable = DB::select($SQLTotalAvaiable);

        // dd($totalAvaiable);

        return view('Admin.page.Product.mainProduct', compact('items', 'totalAvaiable'));
    }

    public function addProduct() {

        $categories = DanhMuc::all();

        return view('Admin.page.Product.addProduct', compact('categories'));
    }

    public function handleAddProduct(Request $request) {
        $file = $request->file('imgProduct');
        $nameProduct = $request->input('nameProduct');
        $descriptionProduct = $request->input('descriptionProduct');
        $priceProduct = $request->input('priceProduct');
        $category = (int)$request->input('category');
        $folderPath = '/storage/Images/Products/';
        $path = '/public/storage/Images/Products/';

        //dd($category);

        if($file) {
            $file_name = $file->getClientOriginalName();
            $pathdata = $folderPath.$file_name;
            $file->move(base_path($path), $file_name);

            DB::table('sanpham')->insert([
                'sp_ten' => $nameProduct,
                'sp_mota' => $descriptionProduct,
                'sp_gia' => $priceProduct,
                'sp_hinhanh' => $pathdata,
                'sp_madm' => $category
            ]);
        } else {
            DB::table('sanpham')->insert([
                'sp_ten' => $nameProduct,
                'sp_mota' => $descriptionProduct,
                'sp_gia' => $priceProduct,
                'sp_madm' => $category
            ]);
        }

        
       return redirect()->route('addProduct');
        
    }

    public function handleUpdateProduct(Request $request) {
        $file = $request->file('imgProduct');
        $nameProduct = $request->input('nameProduct');
        $descriptionProduct = $request->input('descriptionProduct');
        $priceProduct = $request->input('priceProduct');
        $category = $request->input('category');
        $idProduct = $request->input('idProduct');
        $folderPath = '/storage/Images/Products/';
        $path = '/public/storage/Images/Products/';


        if($file) {
            $file_name = $file->getClientOriginalName();
            $pathdata = $folderPath.$file_name;
            $file->move(base_path($path), $file_name);

            $imgOfProduct = SanPham::where('sp_ma', $idProduct)
            ->first()->SP_HinhAnh;
            
            //dd($imgOfProduct);

            if($imgOfProduct) {
                File::delete(public_path($imgOfProduct));
            }

            DB::table('sanpham')->where('sp_ma', $idProduct)->update([
                'sp_ten' => $nameProduct,
                'sp_mota' => $descriptionProduct,
                'sp_gia' => $priceProduct,
                'sp_hinhanh' => $pathdata,
                'sp_madm' => $category
            ]);
        } else {
            DB::table('sanpham')->where('sp_ma', $idProduct)->update([
                'sp_ten' => $nameProduct,
                'sp_mota' => $descriptionProduct,
                'sp_gia' => $priceProduct,
                'sp_madm' => $category
            ]);
        }

        
        return redirect('/admin/product');
    }
    public function getUpdateProduct($id) {
        
        $item = SanPham::where('sp_ma', $id)
        ->join('danhmuc', 'sanpham.sp_madm', '=', 'danhmuc.dm_ma')
        ->first();

        $categories = DanhMuc::all();

        return view('Admin.page.Product.updateProduct', compact('item', 'categories'));    
    }

    public function handleDeleteProduct(Request $request) {
        //dd($id);

        return redirect('/admin/product');
    }



}
