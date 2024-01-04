@extends('layouts.admin')
@section('content')
    @can('user_management_access')
        <div class="d-flex justify-content-start mb-1">
            <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-link">
                &lt;&nbsp;{{ __('global.back_to_list') }}
            </a>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            <h6>{{ __('global.edit') }} {{ __('cruds.user.title_singular') }}</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                @method('PUT')
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">{{ __('cruds.user.fields.name') }}</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $user->name ?? '') }}" class="form-control form-control-sm @error('name') is-invalid @enderror" required>
                    @error('name')
                        <span class="invalid-feedback fw-light fst-italic" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">{{ __('cruds.user.fields.email') }}</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $user->email ?? '') }}" class="form-control form-control-sm @error('email') is-invalid @enderror" required>
                    @error('email')
                        <span class="invalid-feedback fw-light fst-italic" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">{{ __('cruds.user.fields.password') }}</label>
                    <input type="password" name="password" id="password" value="" class="form-control form-control-sm @error('password') is-invalid @enderror">
                    @error('password')
                        <span class="invalid-feedback fw-light fst-italic" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">{{ __('cruds.user.fields.password_confirmation') }}</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" value="" class="form-control form-control-sm @error('password_confirmation') is-invalid @enderror">
                    @error('password_confirmation')
                        <span class="invalid-feedback fw-light fst-italic" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="role_id" class="required">{{ __('cruds.user.fields.role_id') }}</label>
                    <select name="role_id" id="role_id" class="form-control form-control-sm select2 @error('role_id') is-invalid @enderror" required>
                        @if( $roles->count() > 0 )
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}" {{ old('role_id', optional($user->roles->first())->id ?? 2) == $role->id ? 'selected' : '' }}>{{ $role->title }}</option>
                            @endforeach
                        @else
                            <option>{{ __('cruds.user.fields.no_role_id') }}</option>
                        @endif
                    </select>
                    @error('role_id')
                        <span class="invalid-feedback fw-light fst-italic" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                @can('user_management_edit')
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
