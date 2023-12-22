@extends('layouts.admin')
@section('content')
    @can('permission_management_access')
        <div class="row mb-2">
            <div class="col-lg-12">
                <a href="{{ route("admin.permissions.index") }}" class="btn btn-sm btn-link float-start">
                    &lt;&nbsp;{{ __('global.back_to_list') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                <h6>{{ __('global.edit') }} {{ __('cruds.permission.title_singular') }}</h6>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route("admin.permissions.update", [$permission->id]) }}">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="title" class="required">{{ __('cruds.permission.fields.title') }}</label>
                            <input type="text" name="title" id="title" value="{{ old('title', $permission->title ?? '') }}" class="form-control @error('title') is-invalid @enderror" required>
                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        @can('permission_management_edit')
                            <div class="form-group mt-2">
                                <button type="submit" class="btn btn-sm btn-success text-light">
                                    {{ __('global.save') }}
                                </button>
                            </div>
                        @endcan
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
