<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index() {

        $listuser = User::all();
        //dd($listuser);

        
        return view('Admin.page.Users.mainUser', compact('listuser'));
    }
}
