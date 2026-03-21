@extends('layouts.admin.app')

@section('content')

<section class="content">
    <div class="box box-primary">

        <div class="box-header d-flex justify-content-between mb-2">
            <h3 class="box-title">{{ trans('users') }} <small>{{ $users->count() }}</small></h3>
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

                    {{-- Add User Button --}}
                    @can('create', App\Models\User::class)
                        <a class="btn btn-primary" href="{{ route('admin.users.create') }}">
                            <i class="fa fa-plus"></i> {{ trans('add') }}
                        </a>
                    @endcan

                </div>

            </div>
        </form>

        {{-- Table --}}
        <div class="box-body">
            @if ($users->count() > 0)
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ trans('name') }}</th>
                            <th>{{ trans('email') }}</th>
                            <th>{{ trans('permissions') }}</th>
                            <th>{{ trans('actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $index => $user)
                        <tr>
                            {{-- Pagination-aware index --}}
                            <td>{{ $index + 1 + ($users->currentPage() - 1) * $users->perPage() }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @php
                                    $userPermissions = DB::table('users_permissions')
                                                        ->where('user_id', $user->id)
                                                        ->pluck('permission')
                                                        ->toArray();
                                @endphp
                                @foreach ($userPermissions as $perm)
                                    <span class="badge bg-success">{{ $perm }}</span>
                                @endforeach
                            </td>
                            <td>
                                {{-- Edit Button --}}
                                @can('update', $user)
                                    <a class="btn btn-info btn-sm" href="{{ route('admin.users.edit', $user->id) }}">
                                        <i class="fa fa-pencil-square-o"></i> {{ trans('edit') }}
                                    </a>
                                @endcan

                                {{-- Delete Button --}}
                                @can('delete', $user)
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" 
                                          style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
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
                    {{ $users->appends(request()->query())->links() }}
                </div>

            @else
                <h4>{{ trans('no data found') }}</h4>
            @endif
        </div>

    </div>
</section>

@endsection