@extends('layouts.app')

@section('content')
<div class="about-main-content" style="margin-top: -25px; background-image: url('{{asset('assets/images/'.$country->image.'')}}')">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
        <div class="content" style="position: relative; overflow: hidden;">
    <div class="blur-bg" style="background-image: url('{{ asset('assets/images/'.$country->image) }}');"></div>
           <h4 style="color: #fff; font-size: 2rem;">You Booked This Tour Successfully!</h4>
                    <div class="line-dec" style="margin: 20px auto; width: 80px; height: 2px; background-color: #fff;"></div>
                    <p style="color: #f9f9f9; font-size: 1.2rem;">
                        Thank you for booking your tour in <strong>{{ $country->name }}</strong>. We hope you have an amazing experience!
                    </p>
                    <div class="main-button mt-4">
                        <a href="{{ route('home') }}" class="btn btn-primary" style="padding: 10px 20px; font-size: 1rem;">Return to Home</a>
                    </div>
          </div>
        </div>
      </div>
    </div>
  </div>



@endsection



