<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use Auth;

class AuthController extends Controller
{
    public function login() {

        return view('client.pages.login');
    }

    public function postLogin(Request $request) {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ],
        [
            'email.required' => 'Vui lòng nhập email.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
        ]);

        $email = $request->email;
        $password = $request->password;
        $user = User::where('ND_email', $email)->first();

        if($user) {
            if(Auth::attempt(['ND_email' =>$email, 'password' =>$password])) {
                Auth::login($user);
                //dd(Auth::check());
                if($user->ND_MaVT == 2) {
                    return redirect()->route('admin');
                }
                else {
                    return redirect()->route('home');
                }
            } 
            else {
                session()->flash('incorrect-password', 'Mật khẩu chưa đúng, vui lòng nhập lại.');
                return redirect()->route('login');
            }
        }
        else {
            session()->flash('invalid-email', 'Tài khoản không tồn tại.');
            return redirect()->route('login');
        }
        

        //dd($user);
    }

    public function register() {

        return view('client.pages.register');
    }


    public function postRegister(Request $request) {

        $request->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'birthday' => 'required',
            'email' => 'required|email',
            'phone' => 'required|regex:/^0[3,5,7,9][0-9]{8,9}$/',
            'password' => 'required|min:8|max:16',
            'passwordCorrect' => 'required'
        ],
        [
            'firstName' => 'Vui lòng nhập họ và đệm',
            'lastName' => 'Vui lòng nhập tên.',
            'phone.required' => 'Vui lòng nhập số điện thoại.',
            'phone.regex' => 'Vui lòng nhập đúng định dạng.',
            'name.required' => 'Vui lòng nhập tên.',
            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Vui lòng nhập đúng định dạng.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
            'password.min' => 'Mật khẩu ít nhất phải 8 ký tự.',
            'password.max' => 'Mật khẩu tối đa 16 ký tự.',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'birthday.required' => 'Vui lòng nhập ngày sinh.',
            'passwordCorrect' => 'Mật khẩu nhập lại không được để trống.'
        ]);

        $firstName = $request->input('firstName');
        $lastName = $request->input('lastName');
        $birthday = $request->input('birthday');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $password = $request->input('password');

        dd($request);
    }

    public function get403() {
        return view('client.pages.403');
    }

    public function logout() {
        Auth::logout();

        return redirect()->route('login');
    }
}
