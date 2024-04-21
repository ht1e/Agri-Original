<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DanhMuc;
use Illuminate\Support\Facades\DB;


class CategoryController extends Controller
{
    public function index() {

        return view('Admin.page.Categories.allcategory');
    }

    public function addCategory(Request $request) {

        DB::table('danhmuc')->insert([
            'dm_ten' => $request->input('nameCategory')
        ]);
        
        return redirect()->route('admin');
    }
}
