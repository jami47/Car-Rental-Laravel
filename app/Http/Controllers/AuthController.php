<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Car;
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

            //! Get the currently authenticated user
            $user = Auth::user();

            //! Check the usertype of the user
            /* if($user->usertype == 'admin') {
                return redirect('dashboard');
            } else {
                return redirect('home');
            } */
            return redirect('dashboard');
        }

        //! If Invalid Credentials are given,

        Cookie::queue(Cookie::forget('username')); //? Removes cookie
        return redirect('/login')->withError('Invalid Credentials');
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

        //! User Login immediately after successful Registration

        if(Auth::attempt($request->only('email','password')))
        {
            return redirect('home');
        }

        return redirect('register')->withError('Error');

    }

    //! Admin Login
    public function dashpage()
    {
        return view('admin.dashboard');
    }
    public function dashcarpage()
    {
        $cars = Car::all();
        return view('admin.caradmin', ['cars' => $cars]);
        // return view('admin.caradmin');
    }

    public function home()
    {
        if(Auth::user()->usertype == 'user')
        {
            $cars = Car::all();
            return view('user.home', ['cars' => $cars]);
        }

        else
            //return view('admin.dashboard');
            return redirect('dashboard');
    }

    public function logout()
    {
        // Session::flush();
        session()->flush();
        Auth::logout();
        return redirect('/');
    }

}
