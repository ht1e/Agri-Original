<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function getProfile() {
        return view('client.pages.profile');
    }

    public function getOrder($id) {
        dd($id);
    }

}
