<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DonHang;
use Auth;

class ClientController extends Controller
{
    public function getProfile() {

        if(!Auth::check())
            return redirect()->route('login');


        $idUser = Auth::user()->id;

        $dataOrders =  DonHang::where('dh_mand', $idUser)
        ->join('trangthaidonhang', 'donhang.dh_mattdh', '=', 'trangthaidonhang.ttdh_ma')
        ->get();

        
        

        return view('client.pages.profile', compact('dataOrders'));
    }

    public function getOrder($id) {

        $details = DonHang::where('dh_ma', $id)
        ->join('chitietdonhang', 'donhang.dh_ma', '=', 'chitietdonhang.ctdh_madh')
        ->join('sanpham', 'chitietdonhang.ctdh_masp', '=', 'sanpham.sp_ma')
        ->get();

        $status = DonHang::where('dh_ma', $id)->first();

        //dd($details);


        return view('client.pages.orderdetail', compact('id', 'details', 'status'));
    }

}
