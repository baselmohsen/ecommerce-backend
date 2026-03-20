@extends('layouts.admin.app')

@section('content')

<section class="content">

    <div class="box box-primary">

        <div class="box-header d-flex justify-content-between mb-2">
            <h3 class="box-title">{{ trans('add_categories') }}</h3>
            <a class="btn btn-info" href="{{ route('admin.categories.index') }}">
                {{ trans('back') }}
            </a>
        </div>

        <div class="box-body">

            @include('layouts.admin.partials._errors')

            <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
                
                @csrf

                {{-- name (multi language) --}}
                 <div class="form-group">
                    <label>{{ trans('name') }}</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}">

                </div>

                {{-- description --}}
                <div class="form-group">
                    <label>{{ trans('description') }}</label>
                    <textarea name="description" class="form-control">{{ old('description') }}</textarea>
                </div>

                {{-- image --}}
                <div class="form-group">
                    <label>{{ trans('image') }}</label>
                    <input type="file" name="image" class="form-control">
                </div>

                {{-- parent category --}}
                <div class="form-group">
                    <label>{{ trans('parent_category') }}</label>
                    <select name="parent_id" class="form-control">
                        <option value="">{{ trans('no_parent') }}</option>

                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('parent_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach

                    </select>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-plus"></i> {{ trans('add') }}
                    </button>
                </div>

            </form>

        </div>

    </div>

</section>

@endsection