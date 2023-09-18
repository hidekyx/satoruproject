<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login() {
        if (Auth::check()) {
            return redirect('/');
        }
        else {
            return view("main", [
                'page' => "Login",
            ]);
        }
    }

    public function login_action(Request $request) {
        $rules = [
            'email'                 => 'required|email',
            'password'              => 'required|string',
        ];

        $messages = [
            'email.required'        => 'Email wajib diisi',
            'email.email'           => 'Email tidak valid',
            'password.required'     => 'Password wajib diisi',
            'password.string'       => 'Password harus berupa string',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        $data = [
            'email'     => $request->input('email'),
            'password'  => $request->input('password'),
        ];


        $remember = $request->remember ? true : false ;

        Auth::attempt($data, $remember);
    
        if (Auth::check()) {
            $user = User::where('email', $request->input('email'))->first();
            if($user->active == "N") {
                Session::flash('error', 'Akun telah terblokir');
                return redirect('/login');
            }
            
            User::where('id_user',Auth::user()->id)->update(['lastlog' => \Carbon\Carbon::now()]);
            if(Auth::user()->role == "Admin") {
                return redirect('/dashboard');
            }
            else {
                return redirect('/');
            }
        }
        else {
            Session::flash('error', 'Email atau password salah');
            return redirect('/login');
        }    
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function register() {
        return view("main", [
            'page' => "Register",
        ]);
    }

    public function register_action(Request $request) {
        $user = new User([
            'email' => $request->get('email'),
            'no_telp' => $request->get('no_telp'),
            'nama' => $request->get('nama'),
            'alamat' => $request->get('alamat'),
            'password' => bcrypt($request->get('password')),
            'active' => "Y",
        ]);
        if($user->save()) {
            Session::flash('success', 'Silahkan login kembali');
            return redirect('/login');
        }
    }
}