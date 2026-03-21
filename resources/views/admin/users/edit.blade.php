@extends('layouts.admin.app')

@section('content')

<section class="content">

    <div class="box box-primary">

        <div class="box-header d-flex justify-content-between mb-2">
            <h3 class="box-title">{{ trans('edit user') }}</h3>
            <a class="btn btn-info" href="{{ route('admin.users.index') }}">
                <i class="fa fa-arrow-left"></i> {{ trans('back') }}
            </a>
        </div>

        <div class="box-body">

            {{-- Show validation errors --}}
            @include('layouts.admin.partials._errors')

            <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Name --}}
                <div class="form-group">
                    <label>{{ trans('name') }}</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required autofocus>
                </div>

                {{-- Email --}}
                <div class="form-group mt-3">
                    <label>{{ trans('email') }}</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                </div>

                {{-- Password --}}
                <div class="form-group mt-3">
                    <label>{{ trans('password') }} ({{ trans('leave blank if no change') }})</label>
                    <input type="password" name="password" class="form-control">
                </div>

                {{-- Confirm Password --}}
                <div class="form-group mt-3">
                    <label>{{ trans('confirm password') }}</label>
                    <input type="password" name="password_confirmation" class="form-control">
                </div>

                {{-- Permissions --}}
                <div class="form-group mt-3">
                    <label>{{ trans('permissions') }}</label>
                    <div>
                        @foreach ($permissions as $code => $label)
                            <div class="form-check">
                                <input type="checkbox" name="permissions[]" value="{{ $code }}" class="form-check-input" id="perm_{{ $code }}"
                                    {{ in_array($code, $userPermissions) ? 'checked' : '' }}>
                                <label class="form-check-label" for="perm_{{ $code }}">{{ $label }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Submit --}}
                <div class="form-group mt-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-save"></i> {{ trans('update user') }}
                    </button>
                </div>

            </form>

        </div>

    </div>

</section>

@endsection