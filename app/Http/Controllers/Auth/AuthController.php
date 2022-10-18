<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //login file route
    public function index()
    {
        return view('auth.login');
    }
    //registration file route
    public function registration()
    {
        return view('auth.registration');
    }

    // for login
    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard')
                        ->withSuccess('You have Successfully loggedin');
        }

        return redirect("login")->with('success','Oppes! You have entered invalid credentials');
    }

    // for registration
    public function postRegistration(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $data = $request->all();
        $check = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
          ]);

        return redirect("dashboard")->with('success','Great! You can loggedin now');
    }

    //after login
    public function dashboard()
    {
        if(Auth::check()){
            return view('dashboard');
        }

        return redirect("login");
    }

    // logout here
    public function logout() {
        Session::flush();
        Auth::logout();

        return Redirect('login');
    }
}
