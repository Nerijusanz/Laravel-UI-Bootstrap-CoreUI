@extends('layouts.admin')
@section('content')
    @can('role_management_access')
        <div class="d-flex justify-content-start mb-1">
            <a href="{{ route("admin.roles.index") }}" class="btn btn-sm btn-link">
                &lt;&nbsp;{{ __('global.back_to_list') }}
            </a>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            <h6>{{ __('global.show') }} {{ __('cruds.permission.title') }}</h6>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-end mb-1">
                @can('role_management_edit')
                    <a href="{{ route('admin.roles.edit', $role->id) }}" class="btn btn-sm btn-info text-light float-end me-1"><i class="fas fa-edit"></i></a>
                @endcan
                @can('role_management_delete')
                    <button type="submit" class="btn btn-sm btn-danger text-light float-end" onclick="if (confirm('{{ __('global.areYouSure') }}') == true){ event.preventDefault(); document.getElementById('form-role-delete-{{ $role->id }}').submit(); }">
                        <i class="fas fa-trash"></i>
                    </button>
                    <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST" id="form-role-delete-{{ $role->id }}" class="d-none">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    </form>
                @endcan
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <th>
                                {{ __('cruds.role.fields.id') }}
                            </th>
                            <td>
                                {{ $role->id ?? '' }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ __('cruds.role.fields.title') }}
                            </th>
                            <td>
                                {{ $role->title ?? '' }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ __('cruds.role.fields.permissions') }}
                            </th>
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
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
