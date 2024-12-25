<?php

namespace App\Http\Controllers\Traveling;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\City\City;
use App\Models\Country\Country;
use App\Models\Reservation\Reservation;
use Auth;
use Session;
use Redirect;


class TravelingController extends Controller
{
    public function about($id){
        $cities = City::select()->orderBy('id','asc')->take(5)
        ->where('country_id',$id)->get();

        $country = Country::find($id);

        $citiesCount = City::select()->where('country_id',$id)->count();

        return view('traveling.about',compact('cities','country','citiesCount'));
    }

    public function makeReservation($id) {
        $city = City::find($id);
        return view('traveling.reservation', compact('city'));
    }

    // public function storeReservation(Request $request, $id) {

    //     $city = City::find($id);

    //     if($request->check_in_date > date("Y-m-d")){
            
    //         $totalPrice = (int)$city->price * (int)$request->num_guests;
    //         $storeReservation = Reservation::create([

    //             "name" => $request->name,
    //             "phone_number" => $request->phone_number,
    //             "num_guests" => $request->num_guests,
    //             "check_in_date" => $request->check_in_date,
    //             "destination" => $request->destination,
    //             "price" => $totalPrice,
    //             "user_id" => $request->user_id,
                
    //         ]);

    //             if($storeReservation){

    //             $price = Session:: put('price',$city->price * $request->num_guests);
                
    //             $newPrice = Session::get($price);

    //                 echo "reservation is made successfully";
    //             } 
                
            

    //     }else{
    //         echo "invalid date,you need to choose a date in the future";
    //     }

        

       
        

    //     //return view('traveling.reservation', compact('city'));
    public function storeReservation(Request $request, $id)
    {
        // Validation
        $request->validate([
            'name' => 'required|string|max:255',
            'phone_number' => 'required|digits:10',
            'num_guests' => 'required|integer|min:1',
            'check_in_date' => 'required|date|after:today',
            'destination' => 'required|string',
        ], [
            'phone_number.digits' => 'Invalid phone number. Please enter exactly 10 digits.',
            'check_in_date.after' => 'Invalid date, you need to choose a date in the future.',
        ]);
    
        // Find the city and related country
        $city = City::find($id);
        if (!$city) {
            abort(404, 'City not found');
        }
    
        $country = Country::find($city->country_id); // Assuming `City` has a `country_id` column
        if (!$country) {
            abort(404, 'Country not found');
        }
    
        $totalPrice = (int)$city->price * (int)$request->num_guests;
    
        // Create reservation
        $storeReservation = Reservation::create([
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'num_guests' => $request->num_guests,
            'check_in_date' => $request->check_in_date,
            'destination' => $request->destination,
            'price' => $totalPrice,
            'user_id' => Auth::id(),
        ]);
    
        // Store price in session
        Session::put('price', $totalPrice);
    
        // Retrieve price from session (if needed elsewhere)
        $newPrice = Session::get('price');
    
        // Redirect to the payment page
        return redirect()->route('traveling.pay', ['country_id' => $country->id]);

    }
    



public function payWithPaypal($country_id)
{
    // Find the country by ID
    $country = Country::find($country_id);

    if (!$country) {
        abort(404, 'Country not found');
    }



    // Return the payment view with the country details
    return view('traveling.pay', ['country' => $country]);
}


public function success()
{
    // Retrieve the country_id from the session
    $country_id = Session::get('country_id');

    if (!$country_id) {
        abort(404, 'Country ID not found in session');
    }

    $country = Country::find($country_id);

    if (!$country) {
        abort(404, 'Country not found');
    }

    // Check if session price exists
    if (!Session::has('price') || Session::get('price') == 0) {
        abort(403, 'Forbidden: Invalid or missing price');
    }

    // Clear session data
    Session::forget('price');
    Session::forget('country_id');

    return view('success', ['country' => $country]);
}




    }

    
    

   

