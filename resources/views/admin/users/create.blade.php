@extends('layouts.admin.app')

@section('content')

<section class="content">

    <div class="box box-primary">

        <div class="box-header d-flex justify-content-between mb-2">
            <h3 class="box-title">{{ trans('add user') }}</h3>
            <a class="btn btn-info" href="{{ route('admin.users.index') }}">
                <i class="fa fa-arrow-left"></i> {{ trans('back') }}
            </a>
        </div>

        <div class="box-body">

            {{-- Show validation errors --}}
            @include('layouts.admin.partials._errors')

            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf

                {{-- Name --}}
                <div class="form-group">
                    <label>{{ trans('name') }}</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required autofocus>
                </div>

                {{-- Email --}}
                <div class="form-group">
                    <label>{{ trans('email') }}</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                </div>

                {{-- Password --}}
                <div class="form-group">
                    <label>{{ trans('password') }}</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                {{-- Confirm Password --}}
                <div class="form-group">
                    <label>{{ trans('confirm password') }}</label>
                    <input type="password" name="password_confirmation" class="form-control" required>
                </div>

                {{-- Permissions --}}
        <div class="form-group">
            <label>{{ trans('permissions') }}</label>
            <div class="row">
                @foreach ($permissions as $code => $label)
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="form-check">
                            <input type="checkbox" name="permissions[]" value="{{ $code }}" class="form-check-input" id="perm_{{ $code }}">
                            <label class="form-check-label" for="perm_{{ $code }}">{{ $label }}</label>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
                {{-- Submit --}}
                <div class="form-group mt-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-plus"></i> {{ trans('add user') }}
                    </button>
                </div>

            </form>

        </div>

    </div>

</section>

@endsection