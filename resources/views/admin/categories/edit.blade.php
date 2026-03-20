@extends('layouts.admin.app')

@section('content')
    
<section class="content">

    <div class="box box-primary">

        <div class="box-header d-flex justify-content-between mb-2">
            <h3 class="box-title">{{ trans('edit_categories') }}</h3>
            <a class="btn btn-info" href="{{route('admin.categories.index')}}">{{ trans('back') }}</a>


        </div>

        <div class="box-body">

            @include('layouts.admin.partials._errors')
            
            <form action="{{route('admin.categories.update',$category->id)}}" method="POST" >
                
                @csrf
                {{method_field('put')}}

    
                  {{-- name (multi language) --}}
                 <div class="form-group">
                    <label>{{ trans('name') }}</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $category->name) }}">

                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-blus"></i> {{ trans('edit') }}</button>
                
                  </div>
                </div>
              </form>

        </div>

    </div>


</section>

@endsection