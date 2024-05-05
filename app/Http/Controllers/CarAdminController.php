<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;

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

}
