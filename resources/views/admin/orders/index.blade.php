@extends('layouts.admin.app')

@section('content')
<div class="container">
    <h1>Orders</h1>

    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>User</th>
                <th>Total</th>
                <th>Status</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="orders-table-body">
            @forelse($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->first_name . ' ' . $order->last_name ?? 'Guest' }}</td>
                <td>${{ $order->total }}</td>
                <td>{{ ucfirst($order->status) }}</td>
                <td>{{ $order->created_at->diffForHumans() }}</td>
                <td>
                    <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-info btn-sm">view</a>
                    <a href="{{ route('admin.orders.edit', $order->id) }}" class="btn btn-warning btn-sm">edit</a>
                    <form action="{{ route('admin.orders.destroy', $order->id) }}" method="post" style="display:inline-block">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger delete btn-sm">
                            <i class="fa fa-trash"></i> @lang('delete')
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6">No orders found</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{ $orders->links() }}
</div>
@endsection

