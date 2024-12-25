@extends('layouts.app')

@section('content')
<!-- <div class="about-main-content" style="margin-top: -25px; background-image: url('{{asset('assets/images/'.$country->image.'')}}')">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
        <div class="content" style="position: relative; overflow: hidden;">
    <div class="blur-bg" style="background-image: url('{{ asset('assets/images/'.$country->image) }}');"></div>
            <h4>You Booked this tour successfully</h4>
            <div class="line-dec"></div>
            <div class="main-button">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div> -->
  @extends('layouts.app')

@section('content')
<div class="about-main-content" style="margin-top: -25px; background-image: url('{{ asset('assets/images/'.$country->image) }}'); background-size: cover; background-position: center;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <div class="content" style="position: relative; overflow: hidden; padding: 50px; background-color: rgba(0, 0, 0, 0.5); border-radius: 10px;">
                    <div class="blur-bg" style="background-image: url('{{ asset('assets/images/'.$country->image) }}'); opacity: 0.2; position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: -1;"></div>
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



@endsection