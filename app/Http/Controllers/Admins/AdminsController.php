<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\City\City;
use App\Models\Admin\Admin;
use App\Models\Country\Country;
use Redirect;
use File;

class AdminsController extends Controller
{
    public function viewLogin()
    {
        return view('admins.login');
    }

    public function checkLogin(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
        
        $remember_me = $request->has('remember_me') ? true : false;

        // Attempt to log the admin in
        if (auth()->guard('admin')->attempt([
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ], $remember_me)) {
            return redirect()->route('admins.dashboard'); // Redirect to the dashboard route
        }

        // If authentication fails, return to the login page with an error message
        return redirect()->back()->with(['error' => 'Invalid email or password.']);
    }

    public function index()
    {

        $countriesCount = Country::select()->count();
        $citiesCount = City::select()->count();
        $adminsCount = Admin::select()->count();
        return view('admins.index',compact('adminsCount','citiesCount','countriesCount' )); // Ensure this view exists in resources/views/admins/index.blade.php
    }

    public function allAdmins()
    {
        $countriesCount = Country::count();
        $citiesCount = City::count();
        $adminsCount = Admin::count();
        $allAdmins = Admin::orderBy('id', 'desc')->get();
    
        return view('admins.alladmins', compact('allAdmins', 'countriesCount', 'citiesCount', 'adminsCount'));
    }
    
    public function createAdmins()
    {
        
    
        return view('admins.createadmins');
    }

    public function storeAdmins(Request $request)
    {
        
        $storeAdmins = Admin::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password),
        ]);

        if( $storeAdmins){
            return Redirect::route('admins.all.admins')->with(['success'=>'Admin create successfully']);
        }
    }

    public function allCountries(Request $request)
    {

        $allCountries = Country::select()->orderBy('id', 'desc')->get();
    
        return view('admins.allcountries', compact('allCountries'));
    }

    public function createCountries()
    {

    
        return view('admins.createcountries');
    }

    public function storeCountries(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'continent' => 'required|string|max:255',
            'population' => 'required|integer|min:1',
            'territory' => 'required|integer|min:1',
            'avg_price' => 'required|numeric|min:0',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120', // 5MB max
        ]);
    
        try {
            // Handle image upload
            $imageName = null;
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $imageName = time() . '.' . $request->image->getClientOriginalExtension();
                $request->image->move(public_path('assets/images'), $imageName);
            }
    
            // Create a new country record
            Country::create([
                'name' => $request->name,
                'population' => $request->population,
                'territory' => $request->territory,
                'avg_price' => $request->avg_price,
                'description' => $request->description,
                'image' => $imageName,
                'continent' => $request->continent,
            ]);
    
            return redirect()->route('all.countries')->with('success', 'Country created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while creating the country.');
        }
    }
   
    public function deleteCountries($id)
    {

        $deleteCountry = Country::find($id);

        if(File::exists(public_path('assets/images/' . $deleteCountry->image))){
            File::delete(public_path('assets/images/' . $deleteCountry->image));
        }else{
            //dd('File does not exists.');
        }

        $deleteCountry->delete();

        if($deleteCountry){
            return Redirect::route('all.countries')->with(['delete' => 'Country deleted successfully']);
        }
    }

    
    public function allCities(Request $request)
    {
        

        $cities = City::select()->orderBy('id', 'desc')->get();
    
        return view('admins.allcities', compact('cities'));
    } 

    public function createCities()
    {

        $countries = Country::all();

        return view('admins.createcities',compact('countries'));
    }

    public function storeCities(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:40',
            'price' => 'required|string|max:10',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
            'num_days' => 'required|integer|min:1',
            'country_id' => 'required|integer|min:1',
    
        ]);
    
        try {
            // Handle image upload
            $imageName = null;
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $imageName = time() . '.' . $request->image->getClientOriginalExtension();
                $request->image->move(public_path('assets/images'), $imageName);
            }
    
            // Create a new country record
            City::create([
                'name' => $request->name,
                'price' => $request->price,
                'image' => $imageName,
                'num_days' => $request->num_days,
                'country_id' => $request->country_id,
                
            ]);
    
            return redirect()->route('all.cities')->with('success', 'City created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while creating the city.');
        }
    }

    public function deleteCities($id)
    {

        $deleteCity = City::find($id);

        if(File::exists(public_path('assets/images/' . $deleteCity->image))){
            File::delete(public_path('assets/images/' . $deleteCity->image));
        }else{
            //dd('File does not exists.');
        }

        $deleteCity->delete();

        if($deleteCity){
            return Redirect::route('all.cities')->with(['delete' => 'City deleted successfully']);
        }
    }

    
    

    public function logout(Request $request)
    {
        // Log out the admin from the 'admin' guard
        Auth::guard('admin')->logout();

        // Invalidate the session and regenerate the CSRF token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Flash a message if needed for logout success
        $request->session()->flash('message', 'You have been logged out.');

        // Redirect to the login page
        return redirect()->route('view.login');
    }
}
