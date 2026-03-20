@extends('layouts.admin.app')

@section('content')
    
<section class="content">

    <div class="box box-primary">

        <div class="box-header d-flex justify-content-between mb-2">
            <h3 class="box-title">{{ trans('edit_product') }}</h3>
            <a class="btn btn-info" href="{{ route('admin.products.index') }}">{{ trans('back') }}</a>
        </div>

        <div class="box-body">

            @include('layouts.admin.partials._errors')
            
            <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                
                @csrf
                @method('PUT')

                {{-- Name --}}
                <div class="form-group">
                    <label>{{ trans('name') }}</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $product->name) }}">
                </div>

                {{-- Description --}}
                <div class="form-group">
                    <label>{{ trans('description') }}</label>
                    <textarea name="description" class="form-control">{{ old('description', $product->description) }}</textarea>
                </div>

                {{-- Price --}}
                <div class="form-group">
                    <label>{{ trans('price') }}</label>
                    <input type="number" step="0.01" name="price" class="form-control" value="{{ old('price', $product->price) }}">
                </div>

                {{-- Stock --}}
                <div class="form-group">
                    <label>{{ trans('stock') }}</label>
                    <input type="number" name="stock" class="form-control" value="{{ old('stock', $product->stock) }}">
                </div>

                {{-- Expiry Date --}}
                <div class="form-group">
                    <label>{{ trans('expiry_date') }}</label>
                    <input type="date" name="expiry_date" class="form-control" value="{{ old('expiry_date', $product->expiry_date) }}">
                </div>

                {{-- Image --}}
                <div class="form-group">
                    <label>{{ trans('image') }}</label>
                    <input type="file" name="image" class="form-control">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" width="100" class="mt-2">
                    @endif
                </div>

                {{-- Category --}}
                <div class="form-group">
                    <label>{{ trans('category') }}</label>
                    <select name="category_id" class="form-control">
                        <option value="">{{ trans('select_category') }}</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Submit --}}
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-pencil"></i> {{ trans('edit') }}
                    </button>
                </div>

            </form>

        </div>

    </div>

</section>

@endsection