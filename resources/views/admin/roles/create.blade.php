@extends('layouts.admin')
@section('content')
    @can('role_management_access')
        <div class="d-flex justify-content-start mb-1">
            <a href="{{ route('admin.roles.index') }}" class="btn btn-sm btn-link">
                &lt;&nbsp;{{ __('global.back_to_list') }}
            </a>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            <h6>{{ __('global.create') }} {{ __('cruds.role.title_singular') }}</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.roles.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">{{ __('cruds.permission.fields.title') }}</label>
                    <input type="text" name="title" id="title" class="form-control form-control-sm @error('title') is-invalid @enderror" value="{{ old('title', '') }}" required>
                    @error('title')
                        <span class="invalid-feedback fw-light fst-italic" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                @can('role_management_create')
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
