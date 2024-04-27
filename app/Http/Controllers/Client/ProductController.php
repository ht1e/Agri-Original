<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SanPham;
use App\Models\DanhMuc;

class ProductController extends Controller
{
    public function index() {
        $data = SanPham::paginate(8);

        $categories = DanhMuc::all();

        $pricemost = SanPham::max('sp_gia');



        return view('client.pages.mainProduct', compact('data', 'categories', 'pricemost'));
    }

    public function getProductDetails($id) {

        $categories = DanhMuc::all();

        $idCategory = SanPham::where('sp_ma', $id)->first()->SP_MaDM;

        $dataProducts = SanPham::where('sp_madm', $idCategory)->inRandomOrder()->limit(4)->get();

        $data = SanPham::where('sp_ma', $id)
        ->join('danhmuc', 'sanpham.sp_madm', '=', 'danhmuc.dm_ma')
        ->first();

        //dd($idCategory, $dataProducts);

        return view('client.pages.productDetails', compact('categories', 'data', 'dataProducts'));
    }

    public function getCategory($id) {

        $data = DanhMuc::where('dm_ma', $id)
        ->join('sanpham', 'danhmuc.dm_ma', '=', 'sanpham.sp_madm')
        ->paginate(8);

        $categories = DanhMuc::all();

        $pricemost = SanPham::max('sp_gia');


        return view('client.pages.mainProduct', compact('data', 'categories', 'pricemost'));
    }

    public function getSearch(Request $request) {
        $keysearch = $request->input('textSearch');
        $data = SanPham::where('sp_ten', 'LIKE', '%'.$keysearch.'%')->paginate(8);
        $categories = DanhMuc::all();

        $pricemost = SanPham::max('sp_gia');

        //dd($keySearch, $data);

        return view('client.pages.mainProduct', compact('data', 'categories', 'keysearch', 'pricemost'));
    }


    public function filterProduct(Request $request) {
        $categories = DanhMuc::all();
        $pricemost = SanPham::max('sp_gia');

        if($request->has('sort')) {
            $sort = $request->input('sort');
            $inputPrice = $request->input('inputPrice');

            //dd($sort == 1);

            if($sort == 1) {
                $data = SanPham::where('sp_gia', '<=', $inputPrice)
                ->orderBy('sp_gia')
                ->paginate(8);
            }
            else {
                $data = SanPham::where('sp_gia', '<=', $inputPrice)
                ->orderBy('sp_gia', 'desc')
                ->paginate(8);
            }

            return view('client.pages.mainProduct', compact('data', 'categories', 'sort', 'inputPrice', 'pricemost'));
        }
        else {
            $inputPrice = $request->input('inputPrice');

            $data = SanPham::where('sp_gia', '<=', $inputPrice)
            ->paginate(8); 


            return view('client.pages.mainProduct', compact('data', 'categories', 'inputPrice', 'pricemost'));
        }
    } 
}
