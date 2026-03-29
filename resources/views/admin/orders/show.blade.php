@extends('layouts.admin.app')

@section('content')

<section class="content">

    <div class="box box-primary">

        {{-- Header --}}
        <div class="box-header">
            <h3 class="box-title">
                {{ trans('order') }} #{{ $order->id }}
            </h3>
        </div>

        <div class="box-body">

            {{-- Order Info --}}
            <div class="mb-3">
                <p><strong>{{ trans('user') }}:</strong> 
                    {{ $order->first_name && $order->last_name 
                        ? $order->first_name . ' ' . $order->last_name 
                        : trans('guest') }}
                </p>

                <p><strong>{{ trans('email') }}:</strong> {{ $order->email }}</p>
                <p><strong>{{ trans('phone') }}:</strong> {{ $order->phone }}</p>
                <p><strong>{{ trans('address') }}:</strong> {{ $order->address }}, {{ $order->city }}</p>
                <p><strong>{{ trans('status') }}:</strong> {{ ucfirst($order->status) }}</p>
                <p><strong>{{ trans('total') }}:</strong> ${{ $order->total }}</p>
                <p><strong>{{ trans('created at') }}:</strong> {{ $order->created_at->format('d M Y H:i') }}</p>
            </div>

            {{-- Items --}}
            <h4>{{ trans('items') }}</h4>

            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>{{ trans('product') }}</th>
                        <th>{{ trans('quantity') }}</th>
                        <th>{{ trans('price') }}</th>
                        <th>{{ trans('subtotal') }}</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($order->items as $item)
                        <tr>
                            <td>{{ $item->product->name ?? trans('deleted product') }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>${{ $item->price }}</td>
                            <td>${{ $item->price * $item->quantity }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">{{ trans('no data found') }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>

        {{-- Footer --}}
        <div class="box-footer">
            <a href="{{ route('admin.orders.index') }}" class="btn btn-default">
                <i class="fa fa-arrow-left"></i> {{ trans('back') }}
            </a>
        </div>

    </div>

</section>

@endsection