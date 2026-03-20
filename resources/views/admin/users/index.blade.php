@extends('layouts.admin.app')

@section('content')

<section class="content">
    <div class="box box-primary">

        <div class="box-header d-flex justify-content-between mb-2">
            <h3 class="box-title">Users <small>{{ $users->total() }}</small></h3>
            <a class="btn btn-primary" href="{{ route('admin.users.create') }}">
                <i class="fa fa-plus"></i> Add User
            </a>
        </div>

        <div class="box-body">
            @if ($users->count() > 0)
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Permissions</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $index => $user)
                            <tr>
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
                                        <span class="badge bg-secondary">{{ $perm }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    <a class="btn btn-info btn-sm" href="{{ route('admin.users.edit', $user->id) }}">
                                        <i class="fa fa-pencil-square-o"></i> Edit
                                    </a>

                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" 
                                          style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Are you sure?')">
                                            <i class="fa fa-trash"></i> Delete
                                        </button>
                                    </form>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{-- Pagination --}}
                <div class="mt-3">
                    {{ $users->links() }}
                </div>

            @else
                <h4>No users found</h4>
            @endif
        </div>

    </div>
</section>

@endsection