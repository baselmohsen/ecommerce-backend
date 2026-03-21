@extends('layouts.admin.app')

@section('content')
    
<section class="content">

    <div class="box box-primary">

        <div class="box-header d-flex justify-content-between mb-2">
            <h3 class="box-title">{{ trans('products') }} <small>{{ $products->count() }}</small></h3>
        </div>

        {{-- Search Form --}}
        <form action="">
            <div class="row mb-2">

                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" placeholder="{{ trans('search') }}" value="{{ request()->search }}">
                </div>

                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-search"></i> {{ trans('search') }}
                    </button>

                    {{-- Add Product Button --}}
                    @can('create', App\Models\Product::class)
                        <a class="btn btn-primary" href="{{ route('admin.products.create') }}">
                            <i class="fa fa-plus"></i> {{ trans('add') }}
                        </a>
                    @endcan

                </div>

            </div>
        </form>

        {{-- Table --}}
        <div class="box-body">
            @if ($products->count() > 0)
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ trans('name') }}</th>
                            <th>{{ trans('description') }}</th>
                            <th>{{ trans('category') }}</th>
                            <th>{{ trans('price') }}</th>
                            <th>{{ trans('sale price') }}</th>
                            <th>{{ trans('stock') }}</th>
                            <th>{{ trans('expiry_date') }}</th>
                            <th>{{ trans('actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $index => $product)
                        <tr>
                            <td>{{ $index + 1 + ($products->currentPage() - 1) * $products->perPage() }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->description }}</td>
                            <td>{{ $product->category ? $product->category->name : '-' }}</td>
                            <td>{{ $product->price }}</td>
                            <td>{{ $product->sale_price }}</td>
                            <td>{{ $product->stock }}</td>
                            <td>{{ $product->expiry_date ?? '-' }}</td>
                          
                            <td>
                                {{-- Edit Button --}}
                                @can('update', $product)
                                    <a class="btn btn-info btn-sm" href="{{ route('admin.products.edit', $product->id) }}">
                                        <i class="fa fa-pencil-square-o"></i> {{ trans('edit') }}
                                    </a>
                                @endcan

                                {{-- Delete Button --}}
                                @can('delete', $product)
                                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="post" style="display: inline-block">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger delete btn-sm">
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
                    <ul class="pagination">
                        {{ $products->appends(request()->query())->links() }}
                    </ul>
                </div>

            @else
                <h2>{{ trans('no_data_found') }}</h2>
            @endif
        </div>

    </div>

</section>

@endsection