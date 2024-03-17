<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GioHang;
use App\Models\ChiTietGioHang;
use Illuminate\Support\Facades\DB;
use Auth;

class CartController extends Controller
{
    public function getCart() {
        $idUser = Auth::user()->id;
        //dd($idUser);

        $dataCart = GioHang::where('gh_mand', $idUser)
        ->join('chitietgiohang', 'giohang.gh_ma', '=', 'chitietgiohang.ctgh_magh')
        ->join('sanpham', 'chitietgiohang.ctgh_masp', '=', 'sanpham.sp_ma')
        ->get();
        //dd($dataCart);
        return view('client.pages.cart', compact('dataCart'));
    }

    public function updateCart(Request $request) {
        $idProduct = $request->input('idProduct');
        $quantity = $request->input('quantity');
        $idUser = Auth::user()->id;

        $idCart = GioHang::where('gh_mand', $idUser)->get('gh_ma')[0]->gh_ma;

        if($quantity == 0) {
            DB::table('chitietgiohang')
            ->where('ctgh_magh', $idCart)
            ->where('ctgh_masp', $idProduct)
            ->delete();
        }

        DB::table('chitietgiohang')
        ->where('ctgh_magh', $idCart)
        ->where('ctgh_masp', $idProduct)
        ->update(['ctgh_soluong' => $quantity]);

        
        return response()->json(['message' => 'Cart update', 'request' => $request, 'idProduct' => $idProduct, 'quantity' => $quantity, 'idCart' => $idCart]);

    }

    public function addToCart(Request $request) {
        $idProduct = $request->input('idProduct');
        $quantity = $request->input('quantityOfProduct');
        $idUser = Auth::user()->id;
        $idCart = GioHang::where('gh_mand', $idUser)->get('gh_ma')[0]->gh_ma;

        $alreadyProduct = ChiTietGioHang::where('ctgh_magh', $idCart)
        ->where('ctgh_masp', $idProduct)
        ->get('ctgh_soluong');

        if(sizeof($alreadyProduct) > 0) {
            DB::table('chitietgiohang')
            ->where('ctgh_magh', $idCart)
            ->where('ctgh_masp', $idProduct)
            ->update(['ctgh_soluong' => $alreadyProduct[0]->ctgh_soluong + $quantity]);
        }
        else {
            DB::table('chitietgiohang')
            ->insert([
            'ctgh_magh' => $idCart,
            'ctgh_masp' => $idProduct,
            'ctgh_soluong' => 1
            ]);
        }


        return response()->json(['message' => 'Đã thêm vào giỏ hàng', 'idProduct' => $idProduct, 'idUser' => $idUser, 'idCart' => $idCart, 'already' => $alreadyProduct]);

    }
}
