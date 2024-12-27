@extends('layouts.admin')

@section('content') 
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mt-5">Login</h5>
                <form method="POST" action="{{ route('check.login') }}">
    @csrf
    <!-- Email input -->
    <div class="form-outline mb-4">
        <input type="email" name="email" class="form-control" placeholder="Email" />
    </div>
    <!-- Password input -->
    <div class="form-outline mb-4">
        <input type="password" name="password" class="form-control" placeholder="Password" />
    </div>
    <!-- Submit button -->
    <button type="submit" class="btn btn-primary">Login</button>
</form>

            </div>
        </div>
    </div>
</div>
@endsection
