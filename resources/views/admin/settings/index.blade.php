@extends('layouts.admin.app')

@section('content')

<section class="content">

    <div class="box box-primary">

        {{-- Header --}}
        <div class="box-header d-flex justify-content-between mb-2">
            <h3 class="box-title">{{ trans('settings') }}</h3>
        </div>

        <div class="box-body">

            @include('layouts.admin.partials._errors')

            <form action="{{ route('admin.settings') }}" method="POST" enctype="multipart/form-data">
                
                @csrf

                {{-- pharmacy name --}}
                <div class="form-group">
                    <label>{{ trans('pharmacy name') }}</label>
                    <input type="text" name="pharmacy_name" class="form-control"
                           value="{{ old('pharmacy_name', $setting->pharmacy_name ?? '') }}">
                </div>

                {{-- phone --}}
                <div class="form-group">
                    <label>{{ trans('phone') }}</label>
                    <input type="text" name="phone" class="form-control"
                           value="{{ old('phone', $setting->phone ?? '') }}">
                </div>

                {{-- email --}}
                <div class="form-group">
                    <label>{{ trans('email') }}</label>
                    <input type="email" name="email" class="form-control"
                           value="{{ old('email', $setting->email ?? '') }}">
                </div>

                {{-- address --}}
                <div class="form-group">
                    <label>{{ trans('address') }}</label>
                    <input type="text" name="address" class="form-control"
                           value="{{ old('address', $setting->address ?? '') }}">
                </div>

                {{-- facebook --}}
                <div class="form-group">
                    <label>{{ trans('facebook') }}</label>
                    <input type="text" name="facebook" class="form-control"
                           value="{{ old('facebook', $setting->facebook ?? '') }}">
                </div>

                {{-- instagram --}}
                <div class="form-group">
                    <label>{{ trans('instagram') }}</label>
                    <input type="text" name="instagram" class="form-control"
                           value="{{ old('instagram', $setting->instagram ?? '') }}">
                </div>

                {{-- logo --}}
                <div class="form-group">
                    <label>{{ trans('logo') }}</label>
                    <input type="file" name="logo" class="form-control">

                    @if($setting && $setting->logo)
                        <div class="mt-2">
                            <img src="{{ asset('storage/'.$setting->logo) }}" width="120">
                        </div>
                    @endif
                </div>

                {{-- submit --}}
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-save"></i> {{ trans('save settings') }}
                    </button>
                </div>

            </form>

        </div>

    </div>

</section>

@endsection