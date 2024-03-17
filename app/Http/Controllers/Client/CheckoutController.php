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
        

        $idOrder = DB::table('donhang')->insertGetId([
            'dh_thoigian' => date('d-m-Y'),
            'dh_ghichu' => $description,
            'dh_mattdh' => 1,
            'dh_mand' => $userId,
            'dh_tennguoinhan' => $name,
            'dh_diachi' => $address,
            'dh_sdt' => $phone
        ]);


        foreach($listItem as $key => $item) { 
            DB::table('chitietdonhang')->insert([
                'ctdh_madh' => $idOrder,
                'ctdh_masp' => $item,
                'ctdh_soluong' => $listQuantity[$key],
            ]);
        }

        


        return response()->json(['idOrder' => $idOrder, 'message' => 'Đặt hàng thành công']);
        // return redirect()->route('checkout', ['items' => $items]);
    }

    public function getCheckout(Request $request) {

        $idUser = Auth::user()->id;
        $idCart = GioHang::where('gh_mand', $idUser)->get('gh_ma')[0]->gh_ma;
        $total = $request->input('total');

        if($request->has('idProduct') && $request->has('quantity')) {
            $idProduct = $request->input('idProduct');
            $quantity = $request->input('quantity');

            //dd($idProduct, $quantity, $total);

            $alreadyProduct = ChiTietGioHang::where('ctgh_magh', $idCart)
            ->where('ctgh_masp', $idProduct)
            ->get('ctgh_soluong');

            if(sizeof($alreadyProduct) > 0) {
                DB::table('chitietgiohang')
                ->where('ctgh_magh', $idCart)
                ->where('ctgh_masp', $idProduct)
                ->update(['ctgh_soluong' => $quantity]);
            }
            else {
                DB::table('chitietgiohang')
                ->insert([
                'ctgh_magh' => $idCart,
                'ctgh_masp' => $idProduct,
                'ctgh_soluong' => $quantity
                ]);
            }

            $data = ChiTietGioHang::where('ctgh_magh', $idCart)
            ->where('ctgh_maSP', $idProduct)
            ->join('sanpham', 'chitietgiohang.ctgh_masp', '=', 'sanpham.sp_ma')
            ->get();

        } 
        else {
            $items = json_decode($request->input('items'));
            
            $data = ChiTietGioHang::where('ctgh_magh', $idCart)
            ->whereIn('ctgh_maSP', $items)
            ->join('sanpham', 'chitietgiohang.ctgh_masp', '=', 'sanpham.sp_ma')
            ->get();

        }

        
        //dd($data, $total);


        return view('client.pages.checkout', compact('data', 'total')); 
    }
}
