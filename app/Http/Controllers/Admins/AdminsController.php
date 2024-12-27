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
