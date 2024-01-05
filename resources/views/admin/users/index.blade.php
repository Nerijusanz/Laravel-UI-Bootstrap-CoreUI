@extends('layouts.admin')
@section('content')
    @can('user_management_create')
        <div class="d-flex justify-content-start mb-1">
            <a href="{{ route('admin.users.create') }}" class="btn btn-sm btn-success text-light">
                <i class="fas fa-plus"></i>&nbsp;{{ __('global.add') }} {{ __('cruds.user.title_singular') }}
            </a>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            <h6>{{ __('cruds.user.title') }} {{ __('global.list') }}</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>
                                {{ __('cruds.user.fields.id') }}
                            </th>
                            <th>
                                {{ __('cruds.user.fields.name') }}
                            </th>
                            <th>
                                {{ __('cruds.user.fields.email') }}
                            </th>
                            <th>
                                {{ __('cruds.user.fields.role_id') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>
                                    {{ $user->id ?? '' }}
                                </td>
                                <td>
                                    {{ $user->name ?? '' }}
                                </td>
                                <td>
                                    {{ $user->email ?? '' }}
                                </td>
                                <td>
                                    @if(! optional($user->roles->first())->id)
                                        <span class="badge bg-danger">{{ __('cruds.user.fields.no_role_id') }}</span>
                                    @elseif(optional($user->roles->first())->id == 1)
                                        <span class="badge bg-primary">{{ $user->roles->first()->title }}</span>
                                    @else
                                        <span class="badge bg-success">{{ $user->roles->first()->title }}</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex justify-content-end">
                                        @can('user_management_show')
                                            <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-sm btn-primary text-light me-1"><i class="fas fa-eye"></i></a>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center">
                {!! $users->links() !!}
            </div>
        </div>
    </div>
@endsection
