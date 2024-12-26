<?php

namespace App\Http\Controllers\Traveling;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\City\City;
use App\Models\Country\Country;
use App\Models\Reservation\Reservation;
use Auth;
use Session;

class TravelingController extends Controller
{
    public function about($id)
    {
        $cities = City::where('country_id', $id)
            ->orderBy('id', 'asc')
            ->take(5)
            ->get();
        $country = Country::find($id);
        $citiesCount = City::where('country_id', $id)->count();

        return view('traveling.about', compact('cities', 'country', 'citiesCount'));
    }

    public function makeReservation($id)
    {
        $city = City::find($id);
        if (!$city) {
            return redirect()->route('home')->withErrors(['city' => 'City not found.']);
        }
        return view('traveling.reservation', compact('city'));
    }

    public function storeReservation(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone_number' => 'required|digits:10',
            'num_guests' => 'required|integer|min:1',
            'check_in_date' => 'required|date|after:today',
            'destination' => 'required|string',
        ]);

        $city = City::find($id);
        if (!$city) {
            return redirect()->back()->withErrors(['city' => 'City not found.']);
        }

        $totalPrice = (int)$city->price * (int)$request->num_guests;

        Reservation::create([
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'num_guests' => $request->num_guests,
            'check_in_date' => $request->check_in_date,
            'destination' => $request->destination,
            'price' => $totalPrice,
            'user_id' => Auth::id(),
        ]);

        Session::put('price', $totalPrice);
        Session::put('country_id', $city->country_id);

        return redirect()->route('traveling.pay', ['country_id' => $city->country_id]);
    }

    public function payWithPaypal($country_id)
    {
        $country = Country::find($country_id);
        if (!$country) {
            abort(404, 'Country not found');
        }

        return view('traveling.pay', ['country' => $country]);
    }

    public function success()
    {
        $country_id = Session::get('country_id');
        if (!$country_id) {
            return redirect()->route('home')->withErrors(['error' => 'No country information found.']);
        }

        $country = Country::find($country_id);
        if (!$country) {
            return redirect()->route('home')->withErrors(['error' => 'Country not found.']);
        }

        Session::forget(['price', 'country_id']);

        return view('traveling.success', compact('country'));
    }
}
