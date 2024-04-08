<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login (Request $request)
    {
        //! check data
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if(Auth::attempt($request->only('username','password')))
        {
            $remember = $request->has('checkbox');

            if ($remember) {
                //! The checkbox was clicked, store username and password in cookies
                $minutes = 60; // Set the duration for the cookies. Here it's set to 60 minutes.
                Cookie::queue('username', $request->username, $minutes);
                //Cookie::queue('password', $request->password, $minutes);
            }

            return redirect('home');
        }

        //! If Invalid Credentials are given,

        Cookie::queue(Cookie::forget('username')); //? Removes cookie
        return redirect('/log')->withError('Invalid Credentials');
    }

    public function registerpg()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // dd($request->all());
        //! check for data integrity
        $request->validate([
            'name'=>'required',
            'email'=>'required|unique:users|email',
            'password'=>'required'
        ]);

        //! Save the User in the dataBase

        User::create([
            'username'=>$request->name,
            'email'   =>$request->email,
            'password'=> Hash::make($request->password)
        ]);

        //! User Login

        if(Auth::attempt($request->only('email','password')))
        {
            return redirect('home');
        }

        return redirect('register')->withError('Error');

    }

    public function home()
    {
        return view('user.home');
    }

    public function logout()
    {
        // Session::flush();
        session()->flush();
        Auth::logout();
        return redirect('/');
    }

}
