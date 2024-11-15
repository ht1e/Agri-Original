<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GioHang;
use App\Models\ChiTietGioHang;
use App\Models\DonHang;
use App\Models\SanPham;
use App\Models\ChiTietDonHang;
use Illuminate\Support\Facades\DB;
use Auth;

class CheckoutController extends Controller
{
    public function postCheckout(Request $request) {

        $request->validate([
            'address' => 'required',
            'name' => 'required',
            'phone' => 'required',
        ],
        [
            'address.required' => 'Địa chỉ người nhận là bắt buộc.',
            'name.required' => 'Tên người nhận là bắt buộc.',
            'phone.required' => 'Số điện thoại người nhận là bắt buộc'
        ]);

        $description = $request->input('description');
        $address = $request->input('address');
        $name = $request->input('name');
        $phone = $request->input('phone');
        $listItem = $request->input('listItem');
        $listQuantity = $request->input('listQuantity');
        $total = $request->input('total');
        $userId = Auth::user()->id;
        

        $idOrder = DB::table('donhang')->insertGetId([
            'dh_thoigian' => date('Y-m-d'),
            'dh_ghichu' => $description,
            'dh_mattdh' => 1,
            'dh_mand' => $userId,
            'dh_tennguoinhan' => $name,
            'dh_diachi' => $address,
            'dh_sdt' => $phone,
            'dh_tonggiatri' => $total
        ]);


        foreach($listItem as $key => $item) {
            
            $price = SanPham::where('sp_ma', $item)
            ->first()->SP_Gia;

            
            DB::table('chitietdonhang')->insert([
                'ctdh_madh' => $idOrder,
                'ctdh_masp' => (int)$item,
                'ctdh_soluong' => (int)$listQuantity[$key],
                'ctdh_gia' => $price
            ]);
        }


        $idCart = GioHang::where('gh_mand', Auth::user()->id)->first()->GH_Ma;

        ChiTietGioHang::where('ctgh_magh', $idCart)
        ->whereIn('ctgh_masp', $listItem)->delete();


        


        return response()->json(['message' => 'Đặt hàng thành công', 'idOrder' => $idOrder]);
        // return redirect()->route('checkout', ['items' => $items]);
    }

    public function getCheckout(Request $request) {

        // if($_GET)
            // dd($_GET);

        // $idUser = Auth::user()->id;
        // $idCart = GioHang::where('gh_mand', $idUser)->get('gh_ma')[0]->gh_ma;
        // $total = $request->input('total');

        // if($request->has('idProduct') && $request->has('quantity')) {
        //     $idProduct = $request->input('idProduct');
        //     $quantity = $request->input('quantity');

        //     //dd($idProduct, $quantity, $total);

        //     $alreadyProduct = ChiTietGioHang::where('ctgh_magh', $idCart)
        //     ->where('ctgh_masp', $idProduct)
        //     ->get('ctgh_soluong');

        //     if(sizeof($alreadyProduct) > 0) {
        //         DB::table('chitietgiohang')
        //         ->where('ctgh_magh', $idCart)
        //         ->where('ctgh_masp', $idProduct)
        //         ->update(['ctgh_soluong' => $quantity]);
        //     }
        //     else {
        //         DB::table('chitietgiohang')
        //         ->insert([
        //         'ctgh_magh' => $idCart,
        //         'ctgh_masp' => $idProduct,
        //         'ctgh_soluong' => $quantity
        //         ]);
        //     }

        //     $data = ChiTietGioHang::where('ctgh_magh', $idCart)
        //     ->where('ctgh_maSP', $idProduct)
        //     ->join('sanpham', 'chitietgiohang.ctgh_masp', '=', 'sanpham.sp_ma')
        //     ->get();

        // } 
        // else if($request->has('items')) {
        //     $items = json_decode($request->input('items'));
            
        //     $data = ChiTietGioHang::where('ctgh_magh', $idCart)
        //     ->whereIn('ctgh_maSP', $items)
        //     ->join('sanpham', 'chitietgiohang.ctgh_masp', '=', 'sanpham.sp_ma')
        //     ->get();

        // }

        
        //dd($data, $total);


        return view('client.pages.checkout'); 
    }

    public function getItemBuy($id) {

        $idUser = Auth::user()->id;

        $idCart = GioHang::where('gh_mand', $idUser)->get('gh_ma')[0]->gh_ma;

        // dd($idCart);


        $data = ChiTietGioHang::where('ctgh_magh', $idCart)
        ->join('sanpham', 'chitietgiohang.ctgh_masp', '=', 'sanpham.sp_ma')
        ->where('sanpham.sp_ma', (int)$id)
        ->get()[0];



        



        return response()->json(['id' => $id, 'idUser' => $idUser, 'idCart' => $idCart, 'data' => $data]);
    }

    public function getItem($id) {

        $data = SanPham::where('sp_ma', $id)->get()[0];

        return response()->json(['data' =>$data]);
    }
}
