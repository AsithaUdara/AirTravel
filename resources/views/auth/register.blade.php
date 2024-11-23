@extends('layouts.app')

@section('content')
<div class="reservation-form">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- Laravel Register Form -->
                <form id="reservation-form" method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12 text-center">
                            <h4>Register</h4>
                        </div>

                        <!-- Username Field -->
                        <div class="col-md-12">
                            <fieldset>
                                <label for="name" class="form-label">Username</label>
                                <input 
                                    type="text" 
                                    name="name" 
                                    id="name" 
                                    class="form-control @error('name') is-invalid @enderror" 
                                    placeholder="username" 
                                    value="{{ old('name') }}" 
                                    autocomplete="name" 
                                    required 
                                >
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </fieldset>
                        </div>

                        <!-- Email Field -->
                        <div class="col-md-12">
                            <fieldset>
                                <label for="email" class="form-label">Your Email</label>
                                <input 
                                    type="email" 
                                    name="email" 
                                    id="email" 
                                    class="form-control @error('email') is-invalid @enderror" 
                                    placeholder="email" 
                                    value="{{ old('email') }}" 
                                    autocomplete="username" 
                                    required 
                                >
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </fieldset>
                        </div>

                        <!-- Password Field -->
                        <div class="col-md-12">
                            <fieldset>
                                <label for="password" class="form-label">Your Password</label>
                                <input 
                                    type="password" 
                                    name="password" 
                                    id="password" 
                                    class="form-control @error('password') is-invalid @enderror" 
                                    placeholder="password" 
                                    autocomplete="new-password" 
                                    required
                                >
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </fieldset>
                        </div>

                        <!-- Confirm Password Field -->
                        <div class="col-md-12">
                            <fieldset>
                                <label for="password_confirmation" class="form-label">Confirm Password</label>
                                <input 
                                    type="password" 
                                    name="password_confirmation" 
                                    id="password_confirmation" 
                                    class="form-control" 
                                    placeholder="confirm password" 
                                    autocomplete="new-password" 
                                    required
                                >
                            </fieldset>
                        </div>

                        <!-- Register Button -->
                        <div class="col-lg-12">
                            <fieldset>
                                <button type="submit" class="main-button">Register</button>
                            </fieldset>
                        </div>

                        <!-- Login Link -->
                        <div class="col-lg-12 text-center mt-3">
                            <a href="{{ route('login') }}" class="text-decoration-none">Already registered?</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
