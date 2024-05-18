<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Car;
use App\Models\Rent;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index(Request $request, Car $car)
    {
        if(Auth::user()->usertype == 'admin')
        {
            return redirect('dashboard');
        }

        return view('user.rentcar', ['car' => $car]);
    }

    public function addrent(Request $request, Car $car)
    {
        if(Auth::user()->usertype == 'admin')
        {
            return redirect('dashboard');
        }

        // Validate the request...



        if($car->available == "yes")
        {
            // Create a new rent
            $rent = new Rent;
            $rent->car_id = $car->id;
            // $rent->user_id = auth()->id();
            $rent->user_id = Auth::user()->id;
             $rent->start_date = $request->start_date;
             $rent->end_date = $request->end_date;
            /* $rent->start_date = Carbon::parse($request->start_date)->format('Y-m-d'); //! This finally made the date work :)
            // $rent->end_date = $request->end_date;
            $rent->end_date = Carbon::parse($request->end_date)->format('Y-m-d'); */

            //$rent->start_date = Carbon::parse($request->start_date);

            //! $rent->start_date = Carbon::parse($request->start_date)->setTime(12, 0, 0); // Set time to noon
            //$rent->start_date = date('Y-m-d H:i:s', strtotime($request->start_date)); // Format date directly

            // $rent->start_date = Carbon::createFromFormat('d/m/Y', $request->start_date)->format('Y-m-d');
            //DateTime::createFromFormat('m-d-Y', '10-16-2003')->format('Y-m-d');
            /* $rent->start_date = Carbon::createFromFormat('d/m/Y', $request->start_date)->format('Y-m-d');
            $rent->end_date = Carbon::createFromFormat('d/m/Y', $request->end_date)->format('Y-m-d'); */

            $rent->location = $request->location;
            //$rent->location = $request->start_date;

            $rent->save();

            // $car->available = "no";
            $car->available = "no";
            $car->save();

            // Redirect to the previous page
            // return redirect()->back()->back()->with('success', 'Car Rented successfully!');
            //redirect()->to($request->request->get('http_referrer'));
            return redirect()->route('home')->with('success', 'Car Rented successfully!');
        }

        else
        {
            // Redirect the user back with an error message
            return redirect()->route('home')->with('error', 'Car Unavailable');
        }

    }
}
