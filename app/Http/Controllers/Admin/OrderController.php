<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DonHang;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index() {

        $title ='Tất cả đơn hàng';

        $items = DonHang::join('trangthaidonhang', 'donhang.dh_mattdh', '=', 'trangthaidonhang.ttdh_ma')
        ->select('donhang.*', 'trangthaidonhang.*')
        ->orderBy('donhang.dh_ma', 'desc')
        ->get();
        // dd($items);



        return view('Admin.page.Order.mainOrder', compact('items', 'title'));
    }

    public function ordered() {
        $title ='Đơn hàng đã đặt';

        $items = DonHang::where('dh_mattdh', 1)
        ->join('trangthaidonhang', 'donhang.dh_mattdh', '=', 'trangthaidonhang.ttdh_ma')
        ->select('donhang.*', 'trangthaidonhang.*')
        ->orderBy('donhang.dh_ma', 'desc')
        ->get();

        return view('Admin.page.Order.mainOrder', compact('items', 'title'));
    }

    public function acceptOrder() {
        $title ='Đơn hàng đã chấp nhận';


        $items = DonHang::where('dh_mattdh', 4)
        ->join('trangthaidonhang', 'donhang.dh_mattdh', '=', 'trangthaidonhang.ttdh_ma')
        ->select('donhang.*', 'trangthaidonhang.*')
        ->orderBy('donhang.dh_ma', 'desc')
        ->get();

        return view('Admin.page.Order.mainOrder', compact('items', 'title'));
    }
    public function rejectOrder() {

        $title ='Đơn hàng đã hủy';

        $items = DonHang::where('dh_mattdh', 3)
        ->join('trangthaidonhang', 'donhang.dh_mattdh', '=', 'trangthaidonhang.ttdh_ma')
        ->select('donhang.*', 'trangthaidonhang.*')
        ->orderBy('donhang.dh_ma', 'desc')
        ->get();

        return view('Admin.page.Order.mainOrder', compact('items', 'title'));
    }
    public function successOrder() {

        $title = 'Đơn hàng đã thành công';

        $items = DonHang::where('dh_mattdh', 2)
        ->join('trangthaidonhang', 'donhang.dh_mattdh', '=', 'trangthaidonhang.ttdh_ma')
        ->select('donhang.*', 'trangthaidonhang.*')
        ->orderBy('donhang.dh_ma', 'desc')
        ->get();

        return view('Admin.page.Order.mainOrder', compact('items', 'title'));
    }

    public function orderDetails($id) {

        $details = DonHang::where('dh_ma', $id)
        ->join('trangthaidonhang', 'donhang.dh_mattdh', '=', 'trangthaidonhang.ttdh_ma')
        ->join('chitietdonhang', 'donhang.dh_ma', '=', 'chitietdonhang.ctdh_madh')
        ->join('sanpham', 'chitietdonhang.ctdh_masp', '=', 'sanpham.sp_ma')
        ->get();

        $status = DonHang::where('dh_ma', $id)
        ->join('trangthaidonhang', 'donhang.dh_mattdh', '=', 'trangthaidonhang.ttdh_ma')
        ->select('trangthaidonhang.*')
        ->first();

        $totalData = DB::select("
        select distinct sum(sanpham.sp_gia*chitietdonhang.ctdh_soluong) as total
        from donhang, chitietdonhang, sanpham
        where donhang.dh_ma = chitietdonhang.ctdh_madh
        and chitietdonhang.ctdh_masp = sanpham.sp_ma
        and donhang.dh_ma = ".$id);

        $total = $totalData[0]->total;
        // dd($total[0]->total);

        
        //dd($details, $status, $total);

        return view('Admin.page.Order.detailsOrder', compact('details', 'id', 'status', 'total'));
    }

    public function acceptedOrder(Request $request) {

        $type = $request->input('typeOrder');
        $idOrder = $request->input('idOrder');

        DB::table('donhang')->where('dh_ma', $idOrder)
        ->update([
            'dh_mattdh' => $type
        ]);

        return redirect()->route('orderDetails', ['id' => $idOrder]);
    }
}
