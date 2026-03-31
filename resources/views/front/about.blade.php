@extends('layouts.front.app')

@section('content')
<main class="main">

    <!-- BREADCRUMB -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ __('Home') }}</a></li>
                <li class="breadcrumb-item"><a href="#">{{ __('Pages') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('About us') }}</li>
            </ol>
        </div>
    </nav>

    <div class="container">
        <div class="page-header page-header-big text-center" style="background-image: url('{{ asset('assets/images/about-header-bg.jpg') }}')">
            <h1 class="page-title text-white">{{ __('About us') }}<span class="text-white">{{ __('Who we are') }}</span></h1>
        </div>
    </div>

    <div class="page-content pb-0">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mb-3 mb-lg-0">
                    <h2 class="title">{{ __('Our Vision') }}</h2>
                    <p>{{ __('vision_text') }}</p>
                </div>

                <div class="col-lg-6">
                    <h2 class="title">{{ __('Our Mission') }}</h2>
                    <p>{{ __('mission_text') }}</p>
                </div>
            </div>

            <div class="mb-5"></div>
        </div>

        <div class="bg-light-2 pt-6 pb-5 mb-6 mb-lg-8">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 mb-3 mb-lg-0">
                        <h2 class="title">{{ __('Who We Are') }}</h2>
                        <p class="lead text-primary mb-3">{{ __('who_we_are_lead') }}</p>
                        <p class="mb-2">{{ __('who_we_are_text') }}</p>

                        <a href="blog.html" class="btn btn-sm btn-minwidth btn-outline-primary-2">
                            <span>{{ __('VIEW OUR NEWS') }}</span>
                            <i class="icon-long-arrow-right"></i>
                        </a>
                    </div>

                    <div class="col-lg-6 offset-lg-1">
                        <div class="about-images">
                            <img src="{{ asset('assets/images/about/img-1.jpg') }}" alt="" class="about-img-front">
                            <img src="{{ asset('assets/images/about/img-2.jpg') }}" alt="" class="about-img-back">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="brands-text">
                        <h2 class="title">{{ __('brands_title') }}</h2>
                        <p>{{ __('brands_text') }}</p>
                    </div>
                </div>

                <div class="col-lg-7">
                    <div class="brands-display">
                        <div class="row justify-content-center">
                            @for ($i = 1; $i <= 9; $i++)
                            <div class="col-6 col-sm-4">
                                <a href="#" class="brand">
                                    <img src="{{ asset("assets/images/brands/$i.png") }}" alt="{{ __('Brand Name') }}">
                                </a>
                            </div>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>

            <hr class="mt-4 mb-6">

            <h2 class="title text-center mb-4">{{ __('Meet Our Team') }}</h2>
            <div class="row">
                @foreach($team_members as $member)
                <div class="col-md-4">
                    <div class="member member-anim text-center">
                        <figure class="member-media">
                            <img src="{{ asset($member['image']) }}" alt="{{ $member['name'] }}">
                            <figcaption class="member-overlay">
                                <div class="member-overlay-content">
                                    <h3 class="member-title">{{ $member['name'] }}<span>{{ $member['role'] }}</span></h3>
                                    <p>{{ $member['bio'] }}</p>
                                    <div class="social-icons social-icons-simple">
                                        @foreach($member['social'] as $platform => $link)
                                        <a href="{{ $link }}" class="social-icon" title="{{ $platform }}" target="_blank"><i class="icon-{{ strtolower($platform) }}"></i></a>
                                        @endforeach
                                    </div>
                                </div>
                            </figcaption>
                        </figure>
                        <div class="member-content">
                            <h3 class="member-title">{{ $member['name'] }}<span>{{ $member['role'] }}</span></h3>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="mb-2"></div>

           
        </div>
    </div>
</main>
@endsection