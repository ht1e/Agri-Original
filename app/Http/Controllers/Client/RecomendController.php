<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ChiTietDonHang;
use App\Models\ChiTietGioHang;
use Auth;


class RecomendController extends Controller
{
    public function getdataRecomend() {

        if(Auth::check()) {
            $id_user = Auth::user()->id;

            $databuyed = ChiTietDonHang::join('donhang', 'chitietdonhang.ctdh_madh', '=', 'donhang.dh_ma')
            ->where('donhang.dh_mand', $id_user)
            ->distinct()
            ->get('chitietdonhang.ctdh_masp');

            $datacart = ChiTietGioHang::join('giohang', 'chitietgiohang.ctgh_magh', '=', 'giohang.gh_ma')
            ->where('giohang.gh_mand', $id_user)
            ->distinct()
            ->get('chitietgiohang.ctgh_masp');
            return response()->json(["status" => "Success", "databuyed" => $databuyed, 'datacart' => $datacart]);
        }
        
        return response()->json(["status" => "Failed"]);
    }

    public function recomendDashBoard() {
        
        return view('client.pages.recomenddashboard');
    }
}
