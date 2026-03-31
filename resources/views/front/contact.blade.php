@extends('layouts.front.app')

@section('content')
<main class="main">

    <!-- BREADCRUMB -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ __('Home') }}</a></li>
                <li class="breadcrumb-item"><a href="#">{{ __('Pages') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('Contact us') }}</li>
            </ol>
        </div>
    </nav>

    <div class="container">
        <div class="page-header page-header-big text-center" style="background-image: url('{{ asset('assets/images/contact-header-bg.jpg') }}')">
            <h1 class="page-title text-white">{{ __('Contact us') }}<span class="text-white">{{ __('keep in touch with us') }}</span></h1>
        </div>
    </div>

    <div class="page-content pb-0">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mb-2 mb-lg-0">
                    <h2 class="title mb-1">{{ __('Contact Information') }}</h2>
                    <p class="mb-3">{{ __('contact_description') }}</p>

                    <div class="row">
                        <div class="col-sm-7">
                            <div class="contact-info">
                                <h3>{{ __('The Office') }}</h3>

                                <ul class="contact-list">
                                    <li>
                                        <i class="icon-map-marker"></i>
                                        {{ __('office_address') }}
                                    </li>
                                    <li>
                                        <i class="icon-phone"></i>
                                        <a href="tel:#">{{ __('office_phone') }}</a>
                                    </li>
                                    <li>
                                        <i class="icon-envelope"></i>
                                        <a href="mailto:#">{{ __('office_email') }}</a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-sm-5">
                            <div class="contact-info">
                                <h3>{{ __('Office Hours') }}</h3>

                                <ul class="contact-list">
                                    <li>
                                        <i class="icon-clock-o"></i>
                                        <span class="text-dark">{{ __('Monday-Saturday') }}</span> <br>{{ __('hours_weekdays') }}
                                    </li>
                                    <li>
                                        <i class="icon-calendar"></i>
                                        <span class="text-dark">{{ __('Sunday') }}</span> <br>{{ __('hours_sunday') }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <h2 class="title mb-1">{{ __('Got Any Questions?') }}</h2>
                    <p class="mb-2">{{ __('contact_form_description') }}</p>

                    <form action="#" class="contact-form mb-3">
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="cname" class="sr-only">{{ __('Name') }}</label>
                                <input type="text" class="form-control" id="cname" placeholder="{{ __('Name *') }}" required>
                            </div>
                            <div class="col-sm-6">
                                <label for="cemail" class="sr-only">{{ __('Email') }}</label>
                                <input type="email" class="form-control" id="cemail" placeholder="{{ __('Email *') }}" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <label for="cphone" class="sr-only">{{ __('Phone') }}</label>
                                <input type="tel" class="form-control" id="cphone" placeholder="{{ __('Phone') }}">
                            </div>
                            <div class="col-sm-6">
                                <label for="csubject" class="sr-only">{{ __('Subject') }}</label>
                                <input type="text" class="form-control" id="csubject" placeholder="{{ __('Subject') }}">
                            </div>
                        </div>

                        <label for="cmessage" class="sr-only">{{ __('Message') }}</label>
                        <textarea class="form-control" cols="30" rows="4" id="cmessage" required placeholder="{{ __('Message *') }}"></textarea>

                        <button type="submit" class="btn btn-outline-primary-2 btn-minwidth-sm">
                            <span>{{ __('SUBMIT') }}</span>
                            <i class="icon-long-arrow-right"></i>
                        </button>
                    </form>
                </div>
            </div>

            <hr class="mt-4 mb-5">

            <div class="stores mb-4 mb-lg-5">
                <h2 class="title text-center mb-3">{{ __('Our Stores') }}</h2>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="store">
                            <div class="row">
                                <div class="col-sm-5 col-xl-6">
                                    <figure class="store-media mb-2 mb-lg-0">
                                        <img src="{{ asset('assets/images/stores/img-1.jpg') }}" alt="{{ __('store_image') }}">
                                    </figure>
                                </div>
                                <div class="col-sm-7 col-xl-6">
                                    <div class="store-content">
                                        <h3 class="store-title">{{ __('Wall Street Plaza') }}</h3>
                                        <address>{{ __('store1_address') }}</address>
                                        <div><a href="tel:#">{{ __('store1_phone') }}</a></div>

                                        <h4 class="store-subtitle">{{ __('Store Hours:') }}</h4>
                                        <div>{{ __('store1_hours_weekdays') }}</div>
                                        <div>{{ __('store1_hours_sunday') }}</div>

                                        <a href="#" class="btn btn-link" target="_blank"><span>{{ __('View Map') }}</span><i class="icon-long-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="store">
                            <div class="row">
                                <div class="col-sm-5 col-xl-6">
                                    <figure class="store-media mb-2 mb-lg-0">
                                        <img src="{{ asset('assets/images/stores/img-2.jpg') }}" alt="{{ __('store_image') }}">
                                    </figure>
                                </div>
                                <div class="col-sm-7 col-xl-6">
                                    <div class="store-content">
                                        <h3 class="store-title">{{ __('One New York Plaza') }}</h3>
                                        <address>{{ __('store2_address') }}</address>
                                        <div><a href="tel:#">{{ __('store2_phone') }}</a></div>

                                        <h4 class="store-subtitle">{{ __('Store Hours:') }}</h4>
                                        <div>{{ __('store2_hours_weekdays') }}</div>
                                        <div>{{ __('store2_hours_saturday') }}</div>
                                        <div>{{ __('store2_hours_sunday') }}</div>

                                        <a href="#" class="btn btn-link" target="_blank"><span>{{ __('View Map') }}</span><i class="icon-long-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div id="map"></div>
    </div>
</main>
@endsection