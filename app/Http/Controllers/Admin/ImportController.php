<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\HoaDonNhap;
use App\Models\ChiTietHoaDonNhap;
use App\Models\SanPham;
use App\Models\NhaCungCap;



class ImportController extends Controller
{
    public function getImport() {

        $data = HoaDonNhap::join('nhacungcap', 'hoadonnhap.hdn_mancc', '=', 'nhacungcap.ncc_ma')
        ->get();

        return view('Admin.page.ImportBill.Import', compact('data'));
    }

    public function getAddImport() {

        $listProduct = SanPham::all();
        $listProvider = NhaCungCap::all();

        return view('Admin.page.ImportBill.addImport', compact('listProduct', 'listProvider'));
    }

    public function handleAddImport(Request $request) {
        $listIdProduct = $request->input('listIdProduct');
        $listPrice = $request->input('listPrice');
        $listQuantity = $request->input('listQuantity');
        $idProvider = (int)$request->input('idProvider');


        $idImport = DB::table('hoadonnhap')
        ->insertGetId([
            'hdn_thoigian' => date('Y-m-d'),
            'hdn_mancc' => $idProvider
        ]);

        foreach($listIdProduct as $key => $idProduct) {
            DB::table('chitiethoadonnhap')
            ->insert([
                'cthdn_soluong' => $listQuantity[$key],
                'cthdn_masp' => $idProduct,
                'cthdn_mahdn' => $idImport,
                'cthdn_gia' => $listPrice[$key]
            ]);
        }

        //

        

        return response()->json(['success' => 'Thêm hóa đơn thành công!!!']);
        
    }

    public function getDetailsImport($id) {

        $importBill = HoaDonNhap::where('hdn_ma', $id)
        ->join('nhacungcap', 'hoadonnhap.hdn_mancc', '=', 'nhacungcap.ncc_ma')
        ->first();

        $data = ChiTietHoaDonNhap::where('cthdn_mahdn', $id)
        ->join('sanpham', 'chitiethoadonnhap.cthdn_masp', '=', 'sanpham.sp_ma')
        ->get();

        return view('Admin.page.ImportBill.detailsImport', compact('data', 'importBill'));
    }
}
