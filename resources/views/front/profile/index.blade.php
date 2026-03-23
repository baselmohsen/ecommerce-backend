@extends('layouts.front.app')

@section('content')

<div class="container mt-5">

    <div class="card">
        <div class="card-body">

            <!-- TABS -->
            <ul class="nav nav-pills mb-3 justify-content-center" id="profileTabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#user-info">User Info</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#orders">My Orders</a>
                </li>
            </ul>

            <div class="tab-content">

                <!-- USER INFO TAB -->
                <div class="tab-pane fade show active text-center" id="user-info">
                    <h3>Profile</h3>

                    <p><strong>Name:</strong> {{ $user->name }}</p>
                    <p><strong>Email:</strong> {{ $user->email }}</p>

                    @if($user->provider)
                        <p><strong>Login via:</strong> {{ ucfirst($user->provider) }}</p>
                    @else
                        <p><strong>Login via:</strong> Normal Login</p>
                    @endif

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="btn btn-danger mt-3">Logout</button>
                    </form>
                </div>

                <!-- ORDERS TAB -->
                <div class="tab-pane fade" id="orders">
                    <h4 class="mb-3 text-center">My Orders</h4>

                    @forelse($orders as $order)
                        <div class="card mb-3">
                            <div class="card-body">

                                <div class="d-flex justify-content-between mb-2">
                                    <strong>Order #{{ $order->id }}</strong>
                                    <small>{{ $order->created_at->format('Y-m-d') }}</small>
                                </div>

                                <p>Total: ${{ $order->total }}</p>
                                <p>Status: 
                                    <span class="badge badge-info">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </p>

                                <hr>

                                <!-- ORDER ITEMS -->
                                <h6>Items:</h6>

                                @foreach($order->items as $item)
                                    <div class="d-flex justify-content-between border-bottom py-2">
                                        <div>
                                            {{ $item->product->name }}
                                        </div>
                                        <div>
                                            x{{ $item->quantity }} 
                                            - ${{ $item->price }}
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    @empty
                        <p class="text-center">No orders yet.</p>
                    @endforelse

                </div>

            </div>

        </div>
    </div>

</div>

@endsection