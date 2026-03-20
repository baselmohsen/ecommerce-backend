@extends('layouts.admin.app')

@section('content')
    
<section class="content">

    <div class="box box-primary">

        <div class="box-header d-flex justify-content-between mb-2">
            <h3 class="box-title">{{ trans('categories') }} <small>{{ $categories->count() }}</small></h3>
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

                    {{-- Add Category Button --}}
                    @can('create', App\Models\Category::class)
                        <a class="btn btn-primary" href="{{ route('admin.categories.create') }}">
                            <i class="fa fa-plus"></i> {{ trans('add') }}
                        </a>
                    @endcan

                </div>

            </div>
        </form>

        {{-- Table --}}
        <div class="box-body">
            @if ($categories->count() > 0)
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ trans('name') }}</th>
                            <th>{{ trans('description') }}</th>
                            <th>{{ trans('parent') }}</th>
                            <th>{{ trans('actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $index => $category)
                        <tr>
                            <td>{{ $index + 1 + ($categories->currentPage() - 1) * $categories->perPage() }}</td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->description }}</td>
                            <td>{{ $category->parent ? $category->parent->name : '-' }}</td>
                          
                            <td>
                                {{-- Edit Button --}}
                                @can('update', $category)
                                    <a class="btn btn-info btn-sm" href="{{ route('admin.categories.edit', $category->id) }}">
                                        <i class="fa fa-pencil-square-o"></i> {{ trans('edit') }}
                                    </a>
                                @endcan

                                {{-- Delete Button --}}
                                @can('delete', $category)
                                    <form action="{{ route('admin.categories.destroy', $category->id) }}" method="post" style="display: inline-block">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger delete btn-sm">
                                            <i class="fa fa-trash"></i> @lang('delete')
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
                        {{ $categories->appends(request()->query())->links() }}
                    </ul>
                </div>

            @else
                <h2>{{ trans('no_data_found') }}</h2>
            @endif
        </div>

    </div>

</section>

@endsection