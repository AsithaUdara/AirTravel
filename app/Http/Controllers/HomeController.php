<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country\Country; // Ensure the model exists in this namespace

class HomeController extends Controller
{
    /**
     * Constructor to apply middleware.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application home page.
     */
    public function index()
    {
        
        $countries = Country::orderBy('id', 'asc')->get();

        
        return view('home', compact('countries'));
    }
}
