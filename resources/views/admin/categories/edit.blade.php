@extends('layouts.admin.app')

@section('content')
    
<section class="content">

    <div class="box box-primary">

        <div class="box-header d-flex justify-content-between mb-2">
            <h3 class="box-title">{{ trans('edit categories') }}</h3>
            <a class="btn btn-info" href="{{route('admin.categories.index')}}">
                {{ trans('back') }}
            </a>
        </div>

        <div class="box-body">

            @include('layouts.admin.partials._errors')
            
            <form action="{{route('admin.categories.update',$category->id)}}" method="POST" enctype="multipart/form-data">
                
                @csrf
                @method('PUT')

                {{-- name --}}
                <div class="form-group">
                    <label>{{ trans('name') }}</label>
                    <input type="text" name="name" class="form-control"
                        value="{{ old('name', $category->name) }}">
                </div>

                {{-- description --}}
                <div class="form-group">
                    <label>{{ trans('description') }}</label>
                    <textarea name="description" class="form-control">{{ old('description', $category->description) }}</textarea>
                </div>

                {{-- parent category --}}
                <div class="form-group">
                    <label>{{ trans('parent category') }}</label>
                    <select name="parent_id" class="form-control">
                        <option value="">{{ trans('no parent') }}</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}"
                                {{ old('parent_id', $category->parent_id) == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- image --}}
                <div class="form-group">
                    <label>{{ trans('image') }}</label>
                    <input type="file" name="image" class="form-control">
                </div>

                {{-- show current image --}}
                @if($category->image)
                    <div class="form-group">
                        <img src="{{ asset('storage/' . $category->image) }}" width="100">
                    </div>
                @endif

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-edit"></i> {{ trans('edit') }}
                    </button>
                </div>

            </form>

        </div>

    </div>

</section>

@endsection