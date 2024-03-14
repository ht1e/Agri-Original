<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GioHang;
use App\Models\ChiTietGioHang;
use App\Models\DonHang;
use App\Models\ChiTietDonHang;
use Illuminate\Support\Facades\DB;
use Auth;

class CheckoutController extends Controller
{
    public function postCheckout(Request $request) {

        $request->validate([
            'address' => 'required',
            'name' => 'required',
        ],
        [
            'address.required' => 'Địa chỉ người nhận là bắt buộc.',
            'name.required' => 'Tên người nhận là bắt buộc.',
        ]);

        $description = $request->input('description');
        $address = $request->input('address');
        $name = $request->input('name');
        $phone = $request->input('phone');
        $listItem = $request->input('listItem');
        $listQuantity = $request->input('listQuantity');
        $userId = Auth::user()->id;
        

        // $idOrder = DB::table('donhang')->insertGetId([
        //     'dh_thoigian' => date('d-m-Y'),
        //     'dh_ghichu' => $description,
        //     'dh_mattdh' => 1,
        //     'dh_mand' => $userId,
        //     'dh_tennguoinhan' => $name,
        //     'dh_diachi' => $address,
        //     'dh_sdt' => $phone
        // ]);


        // foreach($listItem as $key => $item) { 
        //     DB::table('chitietdonhang')->insert([
        //         'ctdh_madh' => $idOrder,
        //         'ctdh_masp' => $item,
        //         'ctdh_soluong' => $listQuantity[$key],
        //     ]);
        // }

        


        return response()->json(['description' => $description, 'address' => $address, 'name' => $name, 'phone' => $phone, 'listItem' => $listItem,'listQuantity' => $listQuantity, 'userId' => $userId, 'date' => date('d-m-Y')]);
        // return redirect()->route('checkout', ['items' => $items]);
    }

    public function getCheckout(Request $request) {
        $items = json_decode($request->input('items'));
        $total = $request->input('total');

        $idUser = Auth::user()->id;
        $idCart = GioHang::where('gh_mand', $idUser)->get('gh_ma')[0]->gh_ma;

        $data = ChiTietGioHang::where('ctgh_magh', $idCart)
        ->whereIn('ctgh_maSP', $items)
        ->join('sanpham', 'chitietgiohang.ctgh_masp', '=', 'sanpham.sp_ma')
        ->get();
        

        //dd($items, $total, $idCart, $data[0]->SP_Ten);


        return view('client.pages.checkout', compact('data', 'total')); 
    }
}
