@extends('layouts.app')

@section('content')
<div class="reservation-form">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- Laravel Form -->
                <form id="reservation-form"  method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12 ">
                            <h4>Login</h4>
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
                                    autocomplete="email" 
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
                                    autocomplete="current-password" 
                                    required
                                >
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </fieldset>
                        </div>

                        <!-- Login Button -->
                        <div class="col-lg-12">                        
                            <fieldset>
                                <button type="submit" class="main-button">Login</button>
                            </fieldset>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
