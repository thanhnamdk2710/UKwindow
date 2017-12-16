<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Auth;

class HomeController extends Controller
{

    /**
     * Show the content Website
     *
     * @auth: NamDeve
     */
    public function index()
    {
        return view('home');
    }

    public function getLogin()
    {
        return view('back-end.auth.login');
    }

    public function postLogin(LoginRequest $request)
    {
        $auth = [
            'username' => $request->username,
            'password' => $request->password,
        ];

        if (Auth::attempt($auth)) {
            return redirect()->route('admin');
        } else {
            return redirect()->route('login')
                ->with(['message' => 'Email hoặc mật khẩu không đúng.', 'alert' => 'danger']);
        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('index');
    }
}
