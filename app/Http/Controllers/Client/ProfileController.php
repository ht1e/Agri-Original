<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;



class ProfileController extends Controller
{
    public function updateProfile(Request $request) {
        $firstName = $request->input('firstName');
        $lastName = $request->input('lastName');
        $birthday = $request->input('birthday');
        $password = $request->input('password');
        $idUser = Auth::user()->id;

        if($firstName) {
            DB::table('nguoidung')->where('id', $idUser)
            ->update([
                'ND_Ho' => $firstName,
            ]);
        }

        if($lastName) {
            DB::table('nguoidung')->where('id', $idUser)
            ->update([
                'ND_Ten' => $lastName,
            ]);
        }

        if($birthday) {
            DB::table('nguoidung')->where('id', $idUser)
            ->update([
                'ND_NgaySinh' => $birthday,
            ]);
        }

        if($password) {
            DB::table('nguoidung')->where('id', $idUser)
            ->update([
                'password' => bcrypt($password),
            ]);
        }

        return redirect()->route('getProfile');
    }

}
