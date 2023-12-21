@extends('layouts.admin')

@section('content')
    <div class="row mb-2">
        <div class="col-lg-12">
            @can('permission_management_show')
                <a class="btn btn-sm btn-warning" href="{{ route('admin.permissions.show', $permission->id) }}">
                    {{ __('global.view') }}
                </a>
            @endcan
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    {{ __('global.edit') }} {{ __('cruds.permission.title_singular') }}
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route("admin.permissions.update", [$permission->id]) }}">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="title">{{ __('cruds.permission.fields.title') }}</label>
                            <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', $permission->title ?? '') }}" required>
                            @if($errors->has('title'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('title') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group mt-2">
                            <button class="btn btn-sm btn-success" type="submit">
                                {{ __('global.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
