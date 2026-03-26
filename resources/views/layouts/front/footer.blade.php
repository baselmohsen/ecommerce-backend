<footer class="footer">
    <div class="footer-middle">
        <div class="container">
            <div class="row">

                <!-- ABOUT -->
                <div class="col-sm-6 col-lg-3">
                    <div class="widget widget-about">
                    <img src="{{ asset('storage/'.$setting->logo) }}" class="logo-img" alt="logo">
                   
                        <p>{{ __('about text') }}</p>

                        <div class="social-icons">
                            <a href="#" class="social-icon" target="_blank" title="Facebook"><i class="icon-facebook-f"></i></a>
                            <a href="#" class="social-icon" target="_blank" title="Twitter"><i class="icon-twitter"></i></a>
                            <a href="#" class="social-icon" target="_blank" title="Instagram"><i class="icon-instagram"></i></a>
                            <a href="#" class="social-icon" target="_blank" title="Youtube"><i class="icon-youtube"></i></a>
                            <a href="#" class="social-icon" target="_blank" title="Pinterest"><i class="icon-pinterest"></i></a>
                        </div>
                    </div>
                </div>

                <!-- LINKS -->
                <div class="col-sm-6 col-lg-3">
                    <div class="widget">
                        <h4 class="widget-title">{{ __('useful links') }}</h4>

                        <ul class="widget-list">
                            <li><a href="#">{{ __('about') }}</a></li>
                            <li><a href="#">{{ __('how to shop') }}</a></li>
                            <li><a href="#">{{ __('faq') }}</a></li>
                            <li><a href="#">{{ __('contact') }}</a></li>
                            <li><a href="#">{{ __('login') }}</a></li>
                        </ul>
                    </div>
                </div>

                <!-- CUSTOMER SERVICE -->
                <div class="col-sm-6 col-lg-3">
                    <div class="widget">
                        <h4 class="widget-title">{{ __('customer service') }}</h4>

                        <ul class="widget-list">
                            <li><a href="#">{{ __('payment methods') }}</a></li>
                            <li><a href="#">{{ __('money back') }}</a></li>
                            <li><a href="#">{{ __('returns') }}</a></li>
                            <li><a href="#">{{ __('shipping') }}</a></li>
                            <li><a href="#">{{ __('terms') }}</a></li>
                            <li><a href="#">{{ __('privacy') }}</a></li>
                        </ul>
                    </div>
                </div>

                <!-- MY ACCOUNT -->
                <div class="col-sm-6 col-lg-3">
                    <div class="widget">
                        <h4 class="widget-title">{{ __('my account') }}</h4>

                        <ul class="widget-list">
                            <li><a href="#">{{ __('sign in') }}</a></li>
                            <li><a href="{{ route('cart') }}">{{ __('view cart') }}</a></li>
                            <li><a href="#">{{ __('wishlist') }}</a></li>
                            <li><a href="#">{{ __('track order') }}</a></li>
                            <li><a href="#">{{ __('help') }}</a></li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- BOTTOM -->
    <div class="footer-bottom">
        <div class="container">
            <p class="footer-copyright">
                {{ __('copyright') }}
            </p>

            <figure class="footer-payments">
                <img src="{{ asset('assets/images/payments.png') }}" alt="Payment methods">
            </figure>
        </div>
    </div>
</footer>

<button id="scroll-top" title="{{ __('back to top') }}">
    <i class="icon-arrow-up"></i>
</button>

<!-- MOBILE MENU -->
<div class="mobile-menu-overlay"></div>

<div class="mobile-menu-container">
    <div class="mobile-menu-wrapper">
        <span class="mobile-menu-close"><i class="icon-close"></i></span>

        <form action="#" method="get" class="mobile-search">
            <label class="sr-only">{{ __('search') }}</label>
            <input type="search" class="form-control" placeholder="{{ __('search placeholder') }}" required>
            <button class="btn btn-primary" type="submit">
                <i class="icon-search"></i>
            </button>
        </form>

        <nav class="mobile-nav">
            <ul class="mobile-menu">
                <li class="active">
                    <a href="{{ route('home') }}">{{ __('home') }}</a>
                </li>
            </ul>
        </nav>

        <div class="social-icons">
            <a href="#" class="social-icon"><i class="icon-facebook-f"></i></a>
            <a href="#" class="social-icon"><i class="icon-twitter"></i></a>
            <a href="#" class="social-icon"><i class="icon-instagram"></i></a>
            <a href="#" class="social-icon"><i class="icon-youtube"></i></a>
        </div>
    </div>
</div>

<!-- LOGIN MODAL -->
<div class="modal fade" id="signin-modal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">

                <button type="button" class="close" data-dismiss="modal">
                    <span><i class="icon-close"></i></span>
                </button>

                <div class="form-box">
                    <div class="form-tab">

                        <ul class="nav nav-pills nav-fill">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#signin">
                                    {{ __('sign in') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#register">
                                    {{ __('register') }}
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content">

                            <!-- LOGIN -->
                            <div class="tab-pane fade show active" id="signin">
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf

                                    <div class="form-group">
                                        <label>{{ __('email') }}</label>
                                        <input type="text" name="email" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label>{{ __('password') }}</label>
                                        <input type="password" name="password" class="form-control" required>
                                    </div>

                                    <div class="form-footer">
                                        <button type="submit" class="btn btn-outline-primary-2">
                                            <span>{{ __('login') }}</span>
                                        </button>

                                        <label>
                                            <input type="checkbox" name="remember">
                                            {{ __('remember me') }}
                                        </label>

                                        <a href="{{ route('password.request') }}">
                                            {{ __('forgot password') }}
                                        </a>
                                    </div>
                                </form>

                                <p class="text-center">{{ __('or login with') }}</p>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <a href="{{route('auth.socilaite.redirect','google')}}" class="btn btn-login btn-g">
                                            <i class="icon-google"></i>
                                            {{ __('login google') }}
                                        </a>
                                    </div>

                                    <div class="col-sm-6">
                                        <a href="{{route('auth.socilaite.redirect','facebook')}}" class="btn btn-login btn-f">
                                            <i class="icon-facebook-f"></i>
                                            {{ __('login facebook') }}
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- REGISTER -->
                            <div class="tab-pane fade" id="register">
                                <form method="POST" action="{{ route('register') }}">
                                    @csrf

                                    <input type="text" name="name" class="form-control" placeholder="{{ __('name') }}" required>
                                    <input type="email" name="email" class="form-control" placeholder="{{ __('email') }}" required>
                                    <input type="password" name="password" class="form-control" placeholder="{{ __('password') }}" required>
                                    <input type="password" name="password_confirmation" class="form-control" placeholder="{{ __('confirm password') }}" required>

                                    <button type="submit" class="btn btn-outline-primary-2">
                                        {{ __('sign up') }}
                                    </button>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- Plugins JS File -->
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.hoverIntent.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('assets/js/superfish.min.js') }}"></script>
<script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.plugin.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.countdown.min.js') }}"></script>
<!-- before closing body -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Main JS File -->
<script src="{{ asset('assets/js/main.js') }}"></script>
<script src="{{ asset('assets/js/demos/demo-2.js') }}"></script>

<script src="{{ asset('js/app.js') }}"></script>

            {{-- @if(session('success'))
            <script>
            Swal.fire({
                toast: true,                  // Makes it a toast (small rectangle)
                position: 'top-end',          // Top-right corner
                icon: 'success',              // Icon
                title: "{{ session('success') }}", // Message
                showConfirmButton: false,     // No OK button
                timer: 3000,                  // Auto close after 2.5 seconds
                timerProgressBar: true,       // Show a progress bar
                background: '#28a745',        // Optional: green background
                color: '#fff',                // Text color white
            });
            </script>
            @endif

            @if(session('error'))
            <script>
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'error',
                title: "{{ session('error') }}",
                showConfirmButton: false,
                timer: 2500,
                timerProgressBar: true,
                background: '#dc3545',        // Optional: red background
                color: '#fff',
            });
            </script>

         
            @endif --}}









@stack('scripts')

</body>
</html>