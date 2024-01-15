@extends('layouts.admin')
@section('content')
    @can('role_management_create')
        <div class="d-flex justify-content-start mb-1">
            <a href="{{ route('admin.roles.create') }}" class="btn btn-sm btn-success text-light">
                <i class="fas fa-plus"></i>&nbsp;{{ __('global.add') }} {{ __('cruds.role.title_singular') }}
            </a>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            <h6>{{ __('cruds.role.title') }} {{ __('global.list') }}</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>
                                {{ __('cruds.role.fields.id') }}
                            </th>
                            <th>
                                {{ __('cruds.role.fields.title') }}
                            </th>
                            <th>
                                {{ __('cruds.role.fields.permissions') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($roles as $role)
                            <tr>
                                <td>
                                    {{ $role->id ?? '' }}
                                </td>
                                <td>
                                    {{ $role->title ?? '' }}
                                </td>
                                <td>
                                    @if($role->permissions->count() > 0)
                                        @foreach($role->permissions as $permission)
                                            @if($role->id == 1)
                                                <span class="badge bg-primary">{{ $permission->title }}</span>
                                            @else
                                                <span class="badge bg-success">{{ $permission->title }}</span>
                                            @endif
                                        @endforeach
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex justify-content-end">
                                        @can('role_management_show')
                                            <a href="{{ route('admin.roles.show', $role->id) }}" class="btn btn-sm border-0 bg-transparent me-1"><i class="fas fa-eye text-primary"></i></a>
                                        @endcan
                                        @can('role_management_edit')
                                            <a href="{{ route('admin.roles.edit', $role->id) }}" class="btn btn-sm border-0 bg-transparent me-1"><i class="fas fa-edit text-info"></i></a>
                                        @endcan
                                        @can('role_management_delete')
                                            <button type="submit" class="btn btn-sm border-0 bg-transparent" onclick="if (confirm('{{ __('global.areYouSure') }}') == true){ event.preventDefault(); document.getElementById('form-role-delete-{{ $role->id }}').submit(); }">
                                                <i class="fas fa-trash text-danger"></i>
                                            </button>
                                            <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST" id="form-role-delete-{{ $role->id }}" class="d-none">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center">
                {!! $roles->links() !!}
            </div>
        </div>
    </div>
@endsection
