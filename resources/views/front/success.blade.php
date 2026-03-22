@extends('layouts.front.app')
@section('content')
    
  <!-- Start Error Area -->
  <div class="maill-success">
    <div class="d-table">
      <div class="d-table-cell">
        <div class="container">
          <div class="success-content">
            <i class="lni lni-envelope"></i>
            <h2>Your order Sent Successfully</h2>
            <p>Thanks for contacting with us, We will get back to you asap.</p>
            <div class="button">
              <a href="{{route('home')}}" class="btn">Back to Home</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End Error Area -->

@endsection