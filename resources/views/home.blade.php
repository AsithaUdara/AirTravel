@extends('layouts.app')

@section('content')
<section id="section-1">
    <!-- Slider Container -->
    <div class="content-slider">
        <!-- Slider Inputs (For Each Country) -->
        @foreach($countries as $country)
        <input type="radio" id="banner{{ $country->id }}" class="sec-1-input" name="banner" {{ $loop->first ? 'checked' : '' }}>
        @endforeach

        <div class="slider">
            <!-- Slider Items -->
            @foreach($countries as $country)
            <div id="top-banner-{{ $country->id }}" class="banner" style="background-image: url('{{ asset('assets/images/' . $country->image) }}')">
                <div class="banner-inner-wrapper header-text">
                    <div class="main-caption">
                        <h2>Take a Glimpse Into The Beautiful Country Of:</h2>
                        <h1>{{ $country->name }}</h1>
                        <div class="border-button"><a href="about.html">Go There</a></div>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="more-info">
                                    <div class="row">
                                        <div class="col-lg-3 col-sm-6 col-6">
                                            <i class="fa fa-user"></i>
                                            <h4><span>Population:</span><br>{{ $country->population }} M</h4>
                                        </div>
                                        <div class="col-lg-3 col-sm-6 col-6">
                                            <i class="fa fa-globe"></i>
                                            <h4><span>Territory:</span><br>{{ $country->territory }} KM<em>2</em></h4>
                                        </div>
                                        <div class="col-lg-3 col-sm-6 col-6">
                                            <i class="fa fa-home"></i>
                                            <h4><span>AVG Price:</span><br>${{ $country->avg_price }}</h4>
                                        </div>
                                        <div class="col-lg-3 col-sm-6 col-6">
                                            <div class="main-button">
                                                <a href="about.html">Explore More</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Navigation and Progress Bars -->
        <nav>
            <div class="controls">
                @foreach($countries as $country)
                <label for="banner{{ $country->id }}">
                    <span class="progressbar">
                        <span class="progressbar-fill"></span>
                    </span>
                    <span class="text">{{ $loop->iteration }}</span>
                </label>
                @endforeach
            </div>
        </nav>
    </div>
</section>

<!-- Visit Country Section -->
<div class="visit-country">
    <div class="container">
        <div class="row">
            <div class="col-lg-5">
                <div class="section-heading">
                    <h2>Visit One Of Our Countries Now</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore.</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8">
                <div class="items">
                    <div class="row">
                        @foreach ($countries as $country)
                        <div class="col-lg-12">
                            <div class="item">
                                <div class="row">
                                    <div class="col-lg-4 col-sm-5">
                                        <div class="image">
                                            <img src="{{ asset('assets/images/' . $country->image) }}" alt="">
                                        </div>
                                    </div>
                                    <div class="col-lg-8 col-sm-7">
                                        <div class="right-content">
                                            <h4>{{ $country->name }}</h4>
                                            <span>{{ $country->continent }}</span>
                                            <div class="main-button">
                                                <a href="about.html">Explore More</a>
                                            </div>
                                            <p>{{ $country->description }}</p>
                                            <ul class="info">
                                                <li><i class="fa fa-user"></i> {{ $country->population }} Mil People</li>
                                                <li><i class="fa fa-globe"></i> {{ $country->territory }} km²</li>
                                                <li><i class="fa fa-home"></i> ${{ $country->avg_price }}</li>
                                            </ul>
                                            <div class="text-button">
                                                <a href="about.html">Need Directions? <i class="fa fa-arrow-right"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="side-bar-map">
                    <div class="row">
                        <div class="col-lg-12">
                            <div id="map">
                                <iframe src="https://www.google.com/maps/embed?...(your URL here)" width="100%" height="550px" frameborder="0" style="border:0; border-radius: 23px;" allowfullscreen=""></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
