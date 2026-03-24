@include('layouts.front.header')

@include('flash::message')
    <div class="page-wrapper">
       @yield('content')
    </div><!-- End .page-wrapper -->
        
        
@include('layouts.front.footer')