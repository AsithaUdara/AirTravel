<?php

namespace App\Http\Controllers\Traveling;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\City\City;
use App\Models\Country\Country;

class TravelingController extends Controller
{
    public function about($id){
        $cities = City::select()->orderBy('id','asc')->take(5)
        ->where('country_id',$id)->get();

        $country = Country::find($id);

        $citiesCount = City::select()->where('country_id',$id)->count();

        return view('traveling.about',compact('cities','country','citiesCount'));
    }
}
