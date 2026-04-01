@extends('layouts.admin.app')

@section('content')

<section class="content">

    <div class="box box-primary">

        <div class="box-header">
            <h3 class="box-title">{{ trans('Admin Profile') }}</h3>
        </div>

        <div class="box-body">

            @include('layouts.admin.partials._errors')

            <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- BASIC -->
                <div class="form-group">
                    <label>{{ trans('Name') }}</label>
                    <input type="text" name="name" class="form-control"
                        value="{{ old('name', $admin->name) }}">
                </div>

                <div class="form-group">
                    <label>{{ trans('Email') }}</label>
                    <input type="email" name="email" class="form-control"
                        value="{{ old('email', $admin->email) }}">
                </div>

                <!-- PROFILE FIELDS -->
                <div class="form-group">
                    <label>{{ trans('First Name') }}</label>
                    <input type="text" name="first_name" class="form-control"
                        value="{{ old('first_name', $profile->first_name ?? '') }}">
                </div>

                <div class="form-group">
                    <label>{{ trans('Last Name') }}</label>
                    <input type="text" name="last_name" class="form-control"
                        value="{{ old('last_name', $profile->last_name ?? '') }}">
                </div>

                <div class="form-group">
                    <label>{{ trans('Phone') }}</label>
                    <input type="text" name="phone" class="form-control"
                        value="{{ old('phone', $profile->phone ?? '') }}">
                </div>

                <div class="form-group">
                    <label>{{ trans('Address') }}</label>
                    <input type="text" name="address" class="form-control"
                        value="{{ old('address', $profile->address ?? '') }}">
                </div>

                <div class="form-group">
                    <label>{{ trans('City') }}</label>
                    <input type="text" name="city" class="form-control"
                        value="{{ old('city', $profile->city ?? '') }}">
                </div>

                <div class="form-group">
                    <label>{{ trans('Bio') }}</label>
                    <textarea name="bio" class="form-control">{{ old('bio', $profile->bio ?? '') }}</textarea>
                </div>

                <div class="form-group">
                    <label>{{ trans('Social (JSON)') }}</label>
                    <textarea name="social" class="form-control">
{{ old('social', isset($profile->social) ? json_encode($profile->social) : '') }}
                    </textarea>
                </div>

                <div class="form-group">
                    <label>{{ trans('Image') }}</label>
                    <input type="file" name="image" class="form-control">

               
                </div>

                <!-- PASSWORD -->
                <div class="form-group">
                    <label>{{ trans('Password') }}</label>
                    <input type="password" name="password" class="form-control">
                </div>

                <div class="form-group">
                    <label>{{ trans('Confirm Password') }}</label>
                    <input type="password" name="password_confirmation" class="form-control">
                </div>

                <button class="btn btn-primary">
                    <i class="fa fa-save"></i> {{ trans('Save') }}
                </button>

            </form>

        </div>

    </div>

</section>

@endsection