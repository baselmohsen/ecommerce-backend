@extends('layouts.admin.app')

@section('content')
<div class="container">
    <h1>Order #{{ $order->id }}</h1>

    <div class="mb-3">
        <strong>User:</strong> {{ $order->first_name . '' . $order->last_name ?? 'Guest' }} <br>
        <strong>Email:</strong> {{ $order->email }} <br>
        <strong>Phone:</strong> {{ $order->phone }} <br>
        <strong>Address:</strong> {{ $order->address }}, {{ $order->city }} <br>
        <strong>Status:</strong> {{ ucfirst($order->status) }} <br>
        <strong>Total:</strong> ${{ $order->total }} <br>
        <strong>Created At:</strong> {{ $order->created_at->format('d M Y H:i') }}
    </div>

    <h3>Items</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
            <tr>
                <td>{{ $item->product->name ?? 'Deleted Product' }}</td>
                <td>{{ $item->quantity }}</td>
                <td>${{ $item->price }}</td>
                <td>${{ $item->price * $item->quantity }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">Back to Orders</a>
</div>
@endsection