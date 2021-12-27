<?php

namespace App\Http\Controllers;

use App\Http\Controllers\controller;
use Illuminate\Http\Request;
// use App\Models\MitraPengguna;
use Illuminate\Support\Facades\Hash;

class LoginSignupusersController extends Controller
{
    public function loginusers()
    {
        return view('users/LoginUsers');
    }
    public function signupusers()
    {
        return view('users/SignupUsers');
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|min:8|max:20'
        ], [
            'password.min' => 'Password minimal memiliki 8 karakter',
            'password.required' => 'Password anda harus diisikan',
            'email.required' => 'Email anda harus diisikan',
            'email.email' => 'Alamat email tidak valid, gunakan example@gmail.com',
        ]);

        $userInfo = UsersPengguna::where('email', $request->email)->first();
        if (!$userInfo || empty($userInfo)) {
            return back()->with('failed', 'Email anda tidak cocok. Lakukan Pendaftaran');
        } else {
            $request->session()->put('id', $userInfo->id);
            $request->session()->put('name', $userInfo->name);
            $request->session()->put('email', $userInfo->email);
            $request->session()->put('image', $userInfo->image);
            $request->session()->put('password', $userInfo->password);
            return redirect()->intended('/dashboarduser');
        }
        return back()->with('failed', 'Login Gagal!');
    }
    public function signout()
    {
        if (session()->has('id')) {
            session()->pull('id');
            session()->pull('name');
            session()->pull('email');
            session()->pull('image');
            session()->pull('password');
            return redirect()->intended('/');
        }
    }
    public function signup(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:pengguna',
            'password' => 'required|min:8|max:20'
        ], [
            'name.required' => 'Username anda harus diisikan',
            'email.required' => 'Email anda harus diisikan',
            'email.unique' => 'Email anda sudah digunakan',
            'password.required' => 'Password anda harus diisikan',
            'password.min' => 'Password minimal memiliki 8 karakter',
        ]);
        $input = UsersPengguna::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        $request->session()->put('id', $input->id);
        $request->session()->put('name', $input->name);
        $request->session()->put('email', $input->email);
        $request->session()->put('password', $input->password);
        return redirect()->intended('/dashboarduser');
    }

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
