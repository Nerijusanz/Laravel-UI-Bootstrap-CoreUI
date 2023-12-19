@extends('layouts.admin')

@section('content')
    <div class="row mb-2">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.users.index") }}">
                {{ __('global.back_to_list') }}
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    {{ __('global.edit') }} {{ __('cruds.user.title_singular') }}
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route("admin.users.update", [$user->id]) }}">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="name">{{ __('cruds.user.fields.name') }}</label>
                            <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required>
                            @if($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="required" for="email">{{ __('cruds.user.fields.email') }}</label>
                            <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required>
                            @if($errors->has('email'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="required" for="password">{{ __('cruds.user.fields.password') }}</label>
                            <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" type="password" name="password" id="password">
                            @if($errors->has('password'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('password') }}
                                </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label class="required" for="role_id">{{ __('cruds.user.fields.role_id') }}</label>
                            <select class="form-control {{ $errors->has('role_id') ? 'is-invalid' : '' }}" name="role_id" id="role_id" required>
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}" {{ old('role_id', optional($user->roles->first())->id ?? 2) == $role->id ? 'selected' : '' }}>{{ $role->title }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('role_id'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('role_id') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group mt-2">
                            <button class="btn btn-danger" type="submit">
                                {{ __('global.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
