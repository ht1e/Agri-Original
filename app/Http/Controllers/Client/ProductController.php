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

        //dd($data);

        return view('client.pages.mainProduct', compact('data', 'categories'));
    }

    public function getProductDetails($id) {

        return view('client.pages.productDetails');
    }

    public function getCategory($id) {

        $data = DanhMuc::where('dm_ma', $id)
        ->join('sanpham', 'danhmuc.dm_ma', '=', 'sanpham.sp_madm')
        ->paginate(8);

        $categories = DanhMuc::all();


        return view('client.pages.mainProduct', compact('data', 'categories'));
    }

    public function getSearch(Request $request) {
        $keysearch = $request->input('textSearch');
        $data = SanPham::where('sp_ten', 'LIKE', '%'.$keysearch.'%')->paginate(8);
        $categories = DanhMuc::all();

        //dd($keySearch, $data);

        return view('client.pages.mainProduct', compact('data', 'categories', 'keysearch'));
    }


    public function filterProduct(Request $request) {
        $categories = DanhMuc::all();

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

            return view('client.pages.mainProduct', compact('data', 'categories', 'sort', 'inputPrice'));
        }
        else {
            $inputPrice = $request->input('inputPrice');

            $data = SanPham::where('sp_gia', '<=', $inputPrice)
            ->paginate(8); 


            return view('client.pages.mainProduct', compact('data', 'categories', 'inputPrice'));
        }
    } 
}
