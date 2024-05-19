<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use GuzzleHttp\Client;
use App\Models\Car;
use App\Models\User;
use App\Models\Rent;

class CarAdminController extends Controller
{
    //
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required',
            'img' => 'required',
            'year' => 'required|integer|min:1890|max:2024',
            'nameplate' => 'required|min:3',
            'ratepd' => 'required|numeric',
            'price' => 'required|numeric|gt:ratepd'
            // 'available' => 'required',
        ]);

        /* if ($validation->fails()) {
            return redirect()->back()->with('failure', 'Failed to add car.');
        } else {
            Car::create($request->all());
            return redirect()->back()->with('success', 'Car added successfully!');
        } */

        // Create a new car
        Car::create($request->all());

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Car added successfully!');
    }

    public function index()
    {
        $cars = Car::all();

        return view('admin.caradmin', ['cars' => $cars]);
    }

    public function destroy(Car $car)
    {
        $car->delete();

        // return redirect()->route('cars.index');
        return redirect()->back()->with('success', 'Car deleted successfully!');
    }

    public function update(Request $request, Car $car)
    {
        $validated = $request->validate([
            'name' => 'required',
            // 'img' => 'required',
            'year' => 'required|integer|min:1890|max:2024',
            'nameplate' => 'required|min:3',
            'ratepd' => 'required|numeric',
            'price' => 'required|numeric|gt:ratepd'
            // Add validation rules for other attributes as needed
        ]);

        // Check if a new image was uploaded
        $image = $request->img;
        //! Only update the 'img' field if it is not null
        if ($image != ""){
            $request->validate(['img' => 'required']);
            $car->update($request->all());
        }
        else {
            $car->update($request->except('img'));
        }
        // $car->update($validated);
        return redirect()->back()->with('success', 'Car updated successfully!');
    }

    public function dashapipage()
    {
        $client = new Client(); //GuzzleHttp\Client
        $url = "https://api.myjson.online/v1/records/37472189-3ddb-4faf-b926-302391fd6fe9";

        $response = $client->request('GET', $url);

        $statusCode = $response->getStatusCode();
        $body = $response->getBody()->getContents();

        $cars = json_decode($body)->data;
        return view('admin.apiadmin', ['cars' => $cars]);
    }

    public function dashprof()
    {
        return view('admin.profileadmin');
    }

    public function changePassword(Request $request)
    {
        // Validate the new password length
        $request->validate([
            'newPassword' => ['required'],
        ]);

        // Get the currently authenticated user's email
        $email = Auth::user()->email;

        // Find the user with the same email
        $user = User::where('email', $email)->first();

        // Check if the user exists
        if ($user) {
            // Update the user's password
            $user->password = Hash::make($request->newPassword);
            $user->save();

            // Redirect the user back with a success message
            return redirect()->back()->with('success', 'Password changed successfully!');
        } else {
            // Redirect the user back with an error message
            return redirect()->back()->with('error', 'User not found.');
        }
    }

    public function rentadmin()
    {
        //$rents = Rent::all();
        //$cars = $rents->pluck('car'); // This will give you a collection of Car models
         $cars = Car::whereHas('rents')->orderBy('id')->get();
        /*$users = User::whereHas('rents')->get();
        return view('admin.rentsadmin', ['cars' => $cars], ['users' => $users]); */


        //! Get all rents with their related cars and users
        $rents = Rent::with('getcar', 'getuser')->orderBy('car_id')->get();

        // Create a collection to hold the users
        $users = collect();

        // Iterate over the rents
        foreach ($rents as $rent) {
            // Add the user of the rent to the users collection
            // $users->push($rent->getuser);
            if ($rent->getuser) {
                // Add the user of the rent to the users collection
                $users->push($rent->getuser);
            }
        }

        // Pass the cars and users to the view
        return view('admin.rentsadmin', ['cars' => $cars, 'users' => $users]);
    }
}
