@extends('layouts.admin')
@section('content')
    @can('permission_management_access')
        <div class="d-flex justify-content-start mb-1">
            <a href="{{ route('admin.permissions.index') }}" class="btn btn-sm btn-link">
                &lt;&nbsp;{{ __('global.back_to_list') }}
            </a>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            <h6>{{ __('global.edit') }} {{ __('cruds.permission.title_singular') }}</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.permissions.update', $permission->id) }}" method="POST">
                @method('PUT')
                @csrf
                <input type="hidden" name="permission_id" value="{{ $permission->id }}" />
                <div class="mb-3">
                    <label for="title" class="form-label">{{ __('cruds.permission.fields.title') }}</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $permission->title ?? '') }}" class="form-control form-control-sm @error('title') is-invalid @enderror" required>
                    @error('title')
                        <span class="invalid-feedback fw-light fst-italic" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                @can('permission_management_edit')
                    <div class="d-flex justify-content-start">
                        <button type="submit" class="btn btn-sm btn-success text-light">
                            {{ __('global.save') }}
                        </button>
                    </div>
                @endcan
            </form>
        </div>
    </div>
@endsection
