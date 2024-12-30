@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-5 d-inline">Create Country</h5>
                <form method="POST" action="{{ route('store.countries') }}" enctype="multipart/form-data">
                    @csrf

                    <!-- Country Name -->
                    <div class="form-outline mb-4 mt-4">
                        <input type="text" name="name" class="form-control" placeholder="Country Name" value="{{ old('name') }}" />
                        @error('name') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    <!-- Population -->
                    <div class="form-outline mb-4 mt-4">
                        <input type="number" name="population" class="form-control" placeholder="Population" value="{{ old('population') }}" />
                        @error('population') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    <!-- Territory -->
                    <div class="form-outline mb-4 mt-4">
                        <input type="number" name="territory" class="form-control" placeholder="Territory (sq km)" value="{{ old('territory') }}" />
                        @error('territory') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    <!-- Avg Price -->
                    <div class="form-outline mb-4 mt-4">
                        <input type="number" name="avg_price" class="form-control" placeholder="Average Price" step="0.01" value="{{ old('avg_price') }}" />
                        @error('avg_price') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    <!-- Description -->
                    <div class="form-floating mb-4">
                        <textarea name="description" class="form-control" placeholder="Description" style="height: 100px">{{ old('description') }}</textarea>
                        @error('description') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    <!-- Image Upload -->
                    <div class="form-outline mb-4">
                        <input type="file" name="image" class="form-control" />
                        @error('image') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    <!-- Continent -->
                    <div class="form-outline mb-4">
                        <input type="text" name="continent" class="form-control" placeholder="Continent" value="{{ old('continent') }}" />
                        @error('continent') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary mb-4">Create Country</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
