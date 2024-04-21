<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DanhMuc;
use App\Models\SanPham;

class HomeController extends Controller
{
    public function index() {

        $categories = DanhMuc::all();
        $dataProducts = SanPham::skip(2)->take(4)->get();
        $newProducts = SanPham::orderBy('sp_ma', 'desc')->take(4)->get();

        $totalSold = SanPham::join('chitietdonhang', 'sanpham.sp_ma', '=', 'chitietdonhang.ctdh_masp')
        ->selectRaw('sanpham.sp_ma , sum(chitietdonhang.ctdh_soluong) as soluongban')->groupBy('sanpham.sp_ma')->orderBy('soluongban', 'desc')->take(4)->get();

        $idProducts = [];



        foreach($totalSold as $total) {
            array_push($idProducts, $total->sp_ma);
        }

        $mostProducts = SanPham::whereIn('sp_ma', $idProducts)->get();

        $title = 'Trang chủ';
        //dd($totalSold, $idProducts, $mostProducts, $totalSold[0]->sp_ma);

         return view('client.pages.home', compact('categories', 'dataProducts', 'title', 'newProducts', 'mostProducts'));
    }
}
