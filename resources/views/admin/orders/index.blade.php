@extends('layouts.admin.app')

@section('content')

<section class="content">

    <div class="box box-primary">

        {{-- Header --}}
        <div class="box-header d-flex justify-content-between mb-2">
            <h3 class="box-title">
                {{ trans('orders') }} 
                <small>{{ $orders->total() }}</small>
            </h3>
        </div>

        {{-- Search Form --}}
        <form action="">
            <div class="row mb-2">

                <div class="col-md-4">
                    <input type="text" name="search" class="form-control"
                           placeholder="{{ trans('search') }}"
                           value="{{ request()->search }}">
                </div>

                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-search"></i> {{ trans('search') }}
                    </button>

          

                </div>

            </div>
        </form>

        {{-- Table --}}
        <div class="box-body">
            @if ($orders->count() > 0)

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ trans('user') }}</th>
                            <th>{{ trans('total') }}</th>
                            <th>{{ trans('status') }}</th>
                            <th>{{ trans('created at') }}</th>
                            <th>{{ trans('actions') }}</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($orders as $index => $order)
                        <tr>
                            <td>
                                {{ $index + 1 + ($orders->currentPage() - 1) * $orders->perPage() }}
                            </td>

                            <td>
                                {{ $order->first_name && $order->last_name 
                                    ? $order->first_name . ' ' . $order->last_name 
                                    : 'Guest' }}
                            </td>

                            <td>${{ $order->total }}</td>

                            <td>
                                   <span class="badge {{ $order->status == 'completed' ? 'badge-success' : 'badge-info' }}">
                                        {{ trans(ucfirst($order->status)) }}
                                    </span>
                               

                            </td>

                            <td>{{ $order->created_at->diffForHumans() }}</td>

                            <td>
                                {{-- View --}}
                                @can('view', $order)
                                    <a href="{{ route('admin.orders.show', $order->id) }}"
                                       class="btn btn-info btn-sm">
                                        <i class="fa fa-eye"></i> {{ trans('view') }}
                                    </a>
                                @endcan

                                {{-- Edit --}}
                                @can('update', $order)
                                    <a href="{{ route('admin.orders.edit', $order->id) }}"
                                       class="btn btn-warning btn-sm">
                                        <i class="fa fa-edit"></i> {{ trans('edit') }}
                                    </a>
                                @endcan

                                {{-- Delete --}}
                                @can('delete', $order)
                                    <form action="{{ route('admin.orders.destroy', $order->id) }}"
                                          method="post"
                                          style="display:inline-block">
                                        @csrf
                                        @method('delete')

                                        <button type="submit"
                                                class="btn btn-danger delete btn-sm">
                                            <i class="fa fa-trash"></i> {{ trans('delete') }}
                                        </button>
                                    </form>
                                @endcan
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                {{-- Pagination --}}
                <div>
                    {{ $orders->appends(request()->query())->links() }}
                </div>

            @else
                <h2>{{ trans('no data found') }}</h2>
            @endif
        </div>

    </div>

</section>

@endsection