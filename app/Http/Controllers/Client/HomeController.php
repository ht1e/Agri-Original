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
        //dd($dataProducts);

         return view('client.pages.home', compact('categories', 'dataProducts'));
    }
}
