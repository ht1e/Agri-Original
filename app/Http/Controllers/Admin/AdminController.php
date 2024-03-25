<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\DonHang;

class AdminController extends Controller
{
    public function index() {

        $listYear = DB::select('select distinct YEAR(DH_ThoiGian) as year from donhang');

        $totalUser = User::count() - 1;
        $totalOrder = DonHang::count();
        $totalSold = DonHang::sum('dh_tonggiatri');

        //dd($listYear);

        return view('Admin.page.Dashboard.mainPage', compact('listYear', 'totalSold', 'totalUser', 'totalOrder'));
    }

   

    
}
