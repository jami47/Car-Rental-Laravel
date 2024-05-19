<?php

/*
  !I made this middleware to seperate normal Users from the Admin.
*/

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        //return $next($request);

        //! Check if the user is authenticated
        if (Auth::check()) {
            //* Check if the user is an admin
            if (Auth::user()->usertype == 'admin') {
                //* If the user is an admin, proceed with the request
                return $next($request);
                // return redirect('admin.dashboard');
                // return view('admin.dashboard');
            }

            //! If the user is not an admin, redirect to the 'home' page
            return redirect('home');
        }

        //! If the user is not authenticated, go to loginpage
        return redirect('login');

    }
}
