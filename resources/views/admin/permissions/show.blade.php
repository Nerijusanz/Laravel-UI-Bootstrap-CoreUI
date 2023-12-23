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
            <h6>{{ __('global.show') }} {{ __('cruds.permission.title') }}</h6>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-end mb-1">
                @can('permission_management_edit')
                    <a href="{{ route('admin.permissions.edit', $permission->id) }}" class="btn btn-sm btn-info text-light float-end me-1"><i class="fas fa-edit"></i></a>
                @endcan
                @can('permission_management_delete')
                    <button type="submit" class="btn btn-sm btn-danger text-light float-end" onclick="if (confirm('{{ __('global.areYouSure') }}') == true){ event.preventDefault(); document.getElementById('form-permission-delete').submit(); }">
                        <i class="fas fa-trash"></i>
                    </button>
                    <form action="{{ route('admin.permissions.destroy', $permission->id) }}" method="POST" id="form-permission-delete" class="d-none">
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
                                {{ __('cruds.permission.fields.id') }}
                            </th>
                            <td>
                                {{ $permission->id ?? '' }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ __('cruds.permission.fields.title') }}
                            </th>
                            <td>
                                {{ $permission->title ?? '' }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
