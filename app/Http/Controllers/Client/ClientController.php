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

        dd($id);
    }

}
