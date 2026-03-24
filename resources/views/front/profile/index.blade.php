@extends('layouts.front.app')

@section('content')

<main class="main">

    <!-- HEADER -->
    <div class="page-header text-center" style="background-image: url('{{ asset('assets/images/page-header-bg.jpg') }}')">
        <div class="container">
            <h1 class="page-title">My Account<span>Shop</span></h1>
        </div>
    </div>

    <!-- BREADCRUMB -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-3">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item active">My Account</li>
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
                                <a class="nav-link active" data-toggle="tab" href="#tab-dashboard">Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tab-orders">Orders</a>
                            </li>
                            <li class="nav-item">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="nav-link text-left" style="border:none; background:none;">
                                        Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </aside>

                    <!-- CONTENT -->
                    <div class="col-md-8 col-lg-9">
                        <div class="tab-content">

                            <!-- DASHBOARD -->
                            <div class="tab-pane fade show active" id="tab-dashboard">
                                <p>
                                    Hello 
                                    <span class="font-weight-normal text-dark">
                                        {{ $user->name }}
                                    </span>
                                    <br><br>

                                    Email: {{ $user->email }} <br>

                                    Login via: 
                                    @if($user->provider)
                                        {{ ucfirst($user->provider) }}
                                    @else
                                        Normal Login
                                    @endif
                                </p>
                            </div>

                            <!-- ORDERS -->
                        <div class="tab-pane fade" id="tab-orders">
    <h4 class="mb-3">My Orders</h4>

    @if($orders->count())

        <div class="table-responsive">
            <table class="table table-bordered text-center">

                <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Date</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Items</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td>#{{ $order->id }}</td>

                            <td>
                                {{ $order->created_at->format('Y-m-d') }}
                            </td>

                            <td>${{ $order->total }}</td>

                            <td>
                                <span class="badge {{ $order->status == 'completed' ? 'badge-success' : 'badge-info' }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>

                            <td class="text-left">
                                @foreach($order->items as $item)
                                    <div>
                                        • {{ $item->product->name }} 
                                        (x{{ $item->quantity }})
                                    </div>
                                @endforeach
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>

    @else
        <p>No orders yet.</p>

        <a href="{{ url('/shop') }}" class="btn btn-outline-primary-2">
            <span>GO SHOP</span>
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