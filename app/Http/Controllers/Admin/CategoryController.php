<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index() {
        return view('Admin.page.Categories.allcategory');
    }

    public function addCategory(Request $Request) {
        dd($Request);
    }
}
