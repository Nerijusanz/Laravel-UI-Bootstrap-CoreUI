@extends('layouts.admin')

@section('content')
    <div class="row mb-2">
        <div class="col-lg-12">
            <a class="btn btn-sm btn-link" href="{{ route("admin.users.index") }}">
                &lt;&nbsp;{{ __('global.back_to_list') }}
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    {{ __('global.create') }} {{ __('cruds.user.title_singular') }}
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route("admin.users.store") }}">
                        @csrf
                        <div class="form-group">
                            <label class="required" for="name">{{ __('cruds.user.fields.name') }}</label>
                            <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="required" for="email">{{ __('cruds.user.fields.email') }}</label>
                            <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" id="email" value="{{ old('email') }}" required>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="required" for="password">{{ __('cruds.user.fields.password') }}</label>
                            <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" id="password" required>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="required" for="password_confirmation">{{ __('cruds.user.fields.password_confirmation') }}</label>
                            <input class="form-control @error('password_confirmation') is-invalid @enderror" type="password" name="password_confirmation" id="password_confirmation" required>
                            @error('password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="required" for="role">{{ __('cruds.user.fields.role') }}</label>
                            <select class="form-control select2 @error('role') is-invalid @enderror" name="role" id="role" required>
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}" {{ old('role', 2) == $role->id ? 'selected' : '' }}>{{ $role->title }}</option>
                                @endforeach
                            </select>
                            @error('role')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
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
