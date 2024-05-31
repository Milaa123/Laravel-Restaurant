<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
public function index(){
    $data = [
        "title" => "Login",
    ];
    return view("auth.index", $data);
}
public function login(Request $request){
    $messages = [
        'username.required' => 'Tolong isi usernamenya.',
        'password.required' => 'Isi donk passwordnya',
        // Define more custom messages here
        ];
$data = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ], $messages);

    if(Auth::attempt($data)){
$request->session()->regenerate();
            return redirect("/");
    }
return back()-> with("errorMessage", "Gagal Login, Username atau Password Salah");
}

public function logout(){
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect()->route('login');
}
}