@extends('layouts.admin')
@section('content')
    @can('permission_management_create')
        <div class="d-flex justify-content-start mb-1">
            <a href="{{ route('admin.permissions.create') }}" class="btn btn-sm btn-success text-light">
                <i class="fas fa-plus"></i>&nbsp;{{ __('global.add') }} {{ __('cruds.permission.title_singular') }}
            </a>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            <h6>{{ __('cruds.permission.title') }} {{ __('global.list') }}</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>
                                {{ __('cruds.permission.fields.id') }}
                            </th>
                            <th>
                                {{ __('cruds.permission.fields.title') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($permissions as $permission)
                            <tr>
                                <td>
                                    {{ $permission->id ?? '' }}
                                </td>
                                <td>
                                    {{ $permission->title ?? '' }}
                                </td>
                                <td>
                                    <div class="d-flex justify-content-end">
                                        @can('permission_management_show')
                                            <a href="{{ route('admin.permissions.show', $permission->id) }}" class="btn btn-sm btn-primary text-light me-1"><i class="fas fa-eye"></i></a>
                                        @endcan
                                        @can('permission_management_edit')
                                            <a href="{{ route('admin.permissions.edit', $permission->id) }}" class="btn btn-sm btn-info text-light me-1"><i class="fas fa-edit"></i></a>
                                        @endcan
                                        @can('permission_management_delete')
                                            <button type="submit" class="btn btn-sm btn-danger text-light" onclick="if (confirm('{{ __('global.areYouSure') }}') == true){ event.preventDefault(); document.getElementById('form-permission-delete-{{ $permission->id }}').submit(); }">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                            <form action="{{ route('admin.permissions.destroy', $permission->id) }}" method="POST" id="form-permission-delete-{{ $permission->id }}" class="d-none">
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
                {!! $permissions->links() !!}
            </div>
        </div>
    </div>
@endsection
