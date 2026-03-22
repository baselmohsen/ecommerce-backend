@extends('layouts.admin.app')

@section('content')
<div class="container">
    <h1>Edit Order #{{ $order->id }}</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="status" class="form-label">Order Status</label>
            <select name="status" id="status" class="form-control">
                <option value="new" {{ $order->status == 'new' ? 'selected' : '' }}>New</option>
                <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                <option value="on_delivery" {{ $order->status == 'on_delivery' ? 'selected' : '' }}>On Delivery</option>
                <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="notes" class="form-label">Admin Notes</label>
            <textarea name="notes" id="notes" class="form-control" rows="4">{{ $order->notes ?? '' }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update Order</button>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">Back to Orders</a>
    </form>
</div>
@endsection