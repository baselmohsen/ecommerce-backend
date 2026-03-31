@extends('layouts.front.app')

@section('content')

<main class="main">

    <!-- HEADER -->
    <div class="page-header text-center" style="background-image: url('{{ asset('assets/images/page-header-bg.jpg') }}')">
        <div class="container">
            <h1 class="page-title">{{ __('My Account') }}<span>{{ __('Profile') }}</span></h1>
        </div>
    </div>

    <!-- BREADCRUMB -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-3">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ __('Home') }}</a></li>
                <li class="breadcrumb-item active">{{ __('My Profile') }}</li>
            </ol>
        </div>
    </nav>

    <div class="page-content">
        <div class="dashboard">
            <div class="container">
                <div class="row">

                    <!-- SIDEBAR -->
                    <aside class="col-md-4 col-lg-3">
                        <ul class="nav nav-dashboard flex-column">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tab-profile">{{ __('Profile') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tab-orders">{{ __('Orders') }}</a>
                            </li>
                            <li class="nav-item">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="nav-link text-left" style="border:none; background:none;">
                                        {{ __('Logout') }}
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </aside>

                    <!-- CONTENT -->
                    <div class="col-md-8 col-lg-9">
                        <div class="tab-content">

                            <!-- PROFILE -->
                            <div class="tab-pane fade show active" id="tab-profile">
                                <h5>{{ __('Update your profile to make the checkout process easier') }}</h5>

                    

                                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                                    @csrf

                                    <div class="form-group">
                                        <label>{{ __('First Name') }}</label>
                                        <input type="text" name="first_name" value="{{ old('first_name', $profile->first_name ?? '') }}" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label>{{ __('Last Name') }}</label>
                                        <input type="text" name="last_name" value="{{ old('last_name', $profile->last_name ?? '') }}" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label>{{ __('Bio') }}</label>
                                        <textarea name="bio" class="form-control">{{ old('bio', $profile->bio ?? '') }}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label>{{ __('Phone') }}</label>
                                        <input type="text" name="phone" value="{{ old('phone', $profile->phone ?? '') }}" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label>{{ __('Address') }}</label>
                                        <input type="text" name="address" value="{{ old('address', $profile->address ?? '') }}" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label>{{ __('City') }}</label>
                                        <input type="text" name="city" value="{{ old('city', $profile->city ?? '') }}" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label>{{ __('Profile Image') }}</label>
                                        <input type="file" name="image" class="form-control">
                                        @if(!empty($profile->image))
                                            <img src="{{ asset('storage/'.$profile->image) }}" width="100" class="mt-2">
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label>{{ __('Social Links (JSON)') }}</label>
                                        <textarea name="social" class="form-control">{{ old('social', isset($profile->social) ? json_encode($profile->social) : '') }}</textarea>
                                        <small>{{ __('Example: {"Facebook":"https://facebook.com","Twitter":"https://twitter.com"}') }}</small>
                                    </div>

                                    <button type="submit" class="btn btn-success">{{ __('Save Profile') }}</button>
                                </form>
                            </div>

                            <!-- ORDERS -->
                            <div class="tab-pane fade" id="tab-orders">

                                @if($orders->count())
                                    <div class="table-responsive">
                                        <table class="table table-bordered text-center">
                                            <thead>
                                                <tr>
                                                    <th>{{ __('Date') }}</th>
                                                    <th>{{ __('Total') }}</th>
                                                    <th>{{ __('Items') }}</th>
                                                    <th>{{ __('Status') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($orders as  $order)
                                                    <tr>
                                                        <td>{{ $order->created_at->format('Y-m-d') }}</td>
                                                        <td>${{ $order->total }}</td>
                                                             <td class="text-left">
                                                            @foreach($order->items as $item)
                                                                <div>• {{ $item->product->name }} (x{{ $item->quantity }})</div>
                                                            @endforeach
                                                        </td>
                                                           <td>
                                                            <span class="badge 
                                                                @if($order->status == 'completed') badge-success
                                                                @elseif($order->status == 'canseled') badge-danger
                                                                @else badge-info
                                                                @endif
                                                            ">
                                                                {{ ucfirst(trans($order->status)) }}
                                                            </span>

                                                            </td>
                                                   
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <p>{{ __('No orders yet.') }}</p>
                                    <a href="{{ url('/shop') }}" class="btn btn-outline-primary-2">
                                        <span>{{ __('GO SHOP') }}</span>
                                    </a>
                                @endif
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</main>

@endsection