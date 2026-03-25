
<!DOCTYPE html>
<html lang="en">
<!-- molla/cart.html  22 Nov 2019 09:55:06 GMT -->
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{$setting->pharmacy_name}}</title>
    <meta name="keywords" content="HTML5 Template">
    <meta name="description" content="Molla - Bootstrap eCommerce Template">
    <meta name="author" content="p-themes">
    <!-- Favicon -->
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/images/icons/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/images/icons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/icons/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('assets/images/icons/site.webmanifest') }}">
    <link rel="mask-icon" href="{{ asset('assets/images/icons/safari-pinned-tab.svg') }}" color="#666666">
    <link rel="shortcut icon" href="{{ asset('assets/images/icons/favicon.ico') }}">

    <meta name="apple-mobile-web-app-title" content="Molla">
    <meta name="application-name" content="Molla">
    <meta name="msapplication-TileColor" content="#cc9966">
    <meta name="msapplication-config" content="{{ asset('assets/images/icons/browserconfig.xml') }}">
    <meta name="theme-color" content="#ffffff">
        <!-- head section -->
        <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">

    <!-- Plugins CSS File -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
       @stack('styles')
    <!-- Main CSS File -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <style>
        .logo-img {
            max-height: 40px;   
            width: auto;
            object-fit: contain;
        }
    </style>
</head>

<body>
<header class="header">

    <!-- ================= TOP HEADER ================= -->
    <div class="header-top">
        <div class="container d-flex justify-content-between">

            <!-- LEFT -->
            <div class="header-left d-flex align-items-center">

                <!-- Language -->
                <div class="header-dropdown mr-3">
                    <a href="#" data-toggle="dropdown">
                        {{ strtoupper(app()->getLocale()) }}
                    </a>

                    <div class="dropdown-menu">
                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <a class="dropdown-item"
                               href="{{ LaravelLocalization::getLocalizedURL($localeCode) }}">
                                {{ $properties['native'] }}
                            </a>
                        @endforeach
                    </div>
                </div>

                <span class="mx-2">|</span>

                <!-- Social -->
                <div>
                    <span class="mr-2">{{ __('follow us') }}</span>

                    @if($setting && $setting->facebook)
                        <a href="{{ $setting->facebook }}" target="_blank">
                            <i class="icon-facebook-f"></i>
                        </a>
                    @endif

                    @if($setting && $setting->instagram)
                        <a href="{{ $setting->instagram }}" target="_blank">
                            <i class="icon-instagram"></i>
                        </a>
                    @endif
                </div>

            </div>

            <!-- RIGHT -->
            <div class="header-right">
                <ul class="top-menu">
                    <li>
                        <a href="#">{{ __('links') }}</a>

                        <ul>
                            <li>
                                <a href="tel:{{ $setting->phone }}">
                                    <i class="icon-phone"></i> {{ $setting->phone }}
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('wishlist') }}">
                                    <i class="icon-heart-o"></i>
                                    {{ __('wishlist') }} 
                                  
                                    
                                       {{-- ({{ $wishlistCount }})  --}}
                               
                                    
                                </a>
                            </li>

                            <li><a href="#">{{ __('about us') }}</a></li>
                            <li><a href="#">{{ __('contact us') }}</a></li>

                            <!-- Auth -->
                            @if(Auth::check())
                                <li class="dropdown">
                                    <a href="#" data-toggle="dropdown">
                                        <i class="icon-user"></i> {{ Auth::user()->name }}
                                    </a>

                                    <div class="dropdown-menu">
                                        <a href="{{ route('profile') }}" class="dropdown-item">
                                            {{ __('profile') }}
                                        </a>

                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="dropdown-item">
                                                {{ __('logout') }}
                                            </button>
                                        </form>
                                    </div>
                                </li>
                            @else
                                <li>
                                    <a href="#signin-modal" data-toggle="modal">
                                        {{ __('login') }}
                                    </a>
                                </li>
                            @endif

                        </ul>
                    </li>
                </ul>
            </div>

        </div>
    </div>

    <!-- ================= MIDDLE HEADER ================= -->
    <div class="header-middle sticky-header">
        <div class="container d-flex justify-content-between align-items-center">

            <!-- LEFT -->
            <div class="header-left d-flex align-items-center">

                <button class="mobile-menu-toggler">
                    <i class="icon-bars"></i>
                </button>

                <a href="{{ route('home') }}" class="logo">
                    <img src="{{ asset('storage/'.$setting->logo) }}" class="logo-img" alt="logo">
                </a>

                <nav class="main-nav ml-3">
                    <ul class="menu">
                        <li>
                            <a href="{{ route('home') }}">
                                {{ __('home') }}
                            </a>
                        </li>
                    </ul>
                </nav>

            </div>

            <!-- RIGHT -->
               
        <div class="header-right">
            <div class="header-search">
                <a href="#" class="search-toggle" role="button" title="Search"><i class="icon-search"></i></a>
                <form action="#" method="get">
                    <div class="header-search-wrapper">
                        <label for="q" class="sr-only">Search</label>
                        <input type="search" class="form-control" name="q" id="q" placeholder="{{__('Search in...')}}" required>
                    </div><!-- End .header-search-wrapper -->
                </form>
            </div><!-- End .header-search -->
        
           <x-cart-dropdown />
                            

        </div><!-- End .header-right -->


        </div>
    </div>

</header>
        
    