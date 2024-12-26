@extends('layouts.app')

@section('content')
<div class="page-heading">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h4>Searching Results</h4>
                <h2>Amazing Prices &amp; More</h2>
            </div>
        </div>
    </div>
</div>

<div class="search-form">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <form id="search-form" name="gs" method="POST" role="search" action="{{ route('traveling.deals.search') }}">
                    @csrf
                    <div class="row">
                        <div class="col-lg-2">
                            <h4>Sort Deals By:</h4>
                        </div>
                        <div class="col-lg-4">
                            <fieldset>
                                <select name="country_id" class="form-select" aria-label="Default select example" id="chooseLocation">
                                    <option value="" selected>Destinations</option>
                                    @foreach($countries as $country)
                                        <option value="{{ $country->id }}" {{ $country->id == old('country_id', $country_id ?? '') ? 'selected' : '' }}>
                                            {{ $country->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </fieldset>
                        </div>
                        <div class="col-lg-4">
                        <fieldset>
    <select name="price" class="form-select" aria-label="Default select example" id="choosePrice">
        <option value="" selected>Price</option>
        <option value="250" {{ old('price', $price ?? '') == '250' ? 'selected' : '' }}>$250</option>
        <option value="500" {{ old('price', $price ?? '') == '500' ? 'selected' : '' }}>$500</option>
        <option value="750" {{ old('price', $price ?? '') == '750' ? 'selected' : '' }}>$750</option>
        <option value="1000" {{ old('price', $price ?? '') == '1000' ? 'selected' : '' }}>$1,000</option>
        <option value="1500" {{ old('price', $price ?? '') == '1500' ? 'selected' : '' }}>$1,500</option> 
    </select>
</fieldset>

                        </div>
                        <div class="col-lg-2">
                            <fieldset>
                                <button type="submit" class="border-button">Search Results</button>
                            </fieldset>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="amazing-deals">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div class="section-heading text-center">
                    <h2>Best Weekly Offers In Each City</h2>
                </div>
            </div>
            @if($searches->isNotEmpty())
                @foreach($searches as $city)
                    <div class="col-lg-6 col-sm-6">
                        <div class="item">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="image">
                                        <img src="{{ asset('assets/images/'.$city->image) }}" alt="{{ $city->name }}">
                                    </div>
                                </div>
                                <div class="col-lg-6 align-self-center">
                                    <div class="content">
                                        <span class="info">{{ __('*Limited Offer Today') }}</span>
                                        <h4>{{ $city->name }}</h4>
                                        <div class="row">
                                            <div class="col-6">
                                                <i class="fa fa-clock"></i>
                                                <span class="list">{{ $city->num_days }} {{ __('Days') }}</span>
                                            </div>
                                            <div class="col-6">
                                                <i class="fa fa-map"></i>
                                                <span class="list">{{ __('Daily Places') }}</span>
                                            </div>
                                        </div>
                                        <p>
                                            Enjoy your trip
                                        </p>
                                        <div class="main-button">
                                            <a href="{{ route('traveling.reservation', $city->id) }}">{{ __('Make a Reservation') }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <p class="alert alert-success">We have no search like for now</p>
            @endif
        </div>
    </div>
</div>
@endsection
