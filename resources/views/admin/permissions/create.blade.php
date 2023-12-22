@extends('layouts.admin')
@section('content')
    @can('permission_management_access')
        <div class="d-flex justify-content-start mb-1">
            <a href="{{ route("admin.permissions.index") }}" class="btn btn-sm btn-link">
                &lt;&nbsp;{{ __('global.back_to_list') }}
            </a>
        </div>
    @endcan
        <div class="card">
            <div class="card-header">
                <h6>{{ __('global.create') }} {{ __('cruds.permission.title_singular') }}</h6>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route("admin.permissions.store") }}">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">title</label>
                        <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', '') }}" required>
                        @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    @can('permission_management_create')
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
