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
                    <label><strong>{{ trans('permissions') }}</strong></label>

                    <div class="row">

                        @foreach ($groupedPermissions as $group => $perms)

                            <div class="col-md-4">

                                <div class="card shadow-sm mb-3" style="border:1px solid #eee; border-radius:10px;">

                                    <!-- HEADER -->
                                    <div class="card-header d-flex justify-content-between align-items-center"
                                         style="background:#f7f7f7; border-bottom:1px solid #eee;">

                                        <strong>{{ ucfirst($group) }}</strong>

                                        <input type="checkbox"
                                               class="select-all"
                                               data-group="{{ $group }}">
                                    </div>

                                    <!-- BODY -->
                                    <div class="card-body">

                                        @foreach ($perms as $key => $label)
                                            <div class="form-check mb-2">
                                                <input type="checkbox"
                                                       name="permissions[]"
                                                       value="{{ $key }}"
                                                       class="form-check-input perm-{{ $group }}"
                                                       id="perm_{{ $key }}"
                                                       {{ in_array($key, $userPermissions) ? 'checked' : '' }}>

                                                <label class="form-check-label" for="perm_{{ $key }}">
                                                    {{ $label }}
                                                </label>
                                            </div>
                                        @endforeach

                                    </div>

                                </div>

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

@push('scripts')
<script>
document.querySelectorAll('.select-all').forEach(function (checkbox) {
    checkbox.addEventListener('change', function () {
        let group = this.dataset.group;

        document.querySelectorAll('.perm-' + group).forEach(function (el) {
            el.checked = checkbox.checked;
        });
    });
});

// Auto-check "select all" if all group permissions are already checked
document.querySelectorAll('.select-all').forEach(function(checkbox) {
    let group = checkbox.dataset.group;
    let items = document.querySelectorAll('.perm-' + group);
    if ([...items].every(el => el.checked)) {
        checkbox.checked = true;
    }
});
</script>
@endpush