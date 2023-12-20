@extends('layouts.admin')

@section('content')
    <div class="row mb-2">
        <div class="col-lg-12">
            <a class="btn btn-sm btn-link float-start" href="{{ route("admin.users.index") }}">
                &lt;&nbsp;{{ __('global.back_to_list') }}
            </a>
            @can('user_management_delete')
                <button type="submit" class="btn btn-sm btn-danger float-end" onclick="if (confirm('{{ __('global.areYouSure') }}') == true){ event.preventDefault(); document.getElementById('admin-user-delete-form').submit(); }">
                    <i class="fas fa-trash"></i>
                </button>
                <form action="{{ route('admin.users.destroy', $user->id) }}" id="admin-user-delete-form" method="POST" style="display: none" );">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                </form>
            @endcan
            @can('user_management_edit')
                <a class="btn btn-sm btn-success float-end" href="{{ route('admin.users.edit', $user->id) }}"><i class="fas fa-edit"></i></a>
            @endcan
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    {{ __('global.show') }} {{ __('cruds.user.title') }}
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <tbody>
                            <tr>
                                <th>
                                    {{ __('cruds.user.fields.id') }}
                                </th>
                                <td>
                                    {{ $user->id ?? '' }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ __('cruds.user.fields.name') }}
                                </th>
                                <td>
                                    {{ $user->name ?? '' }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ __('cruds.user.fields.email') }}
                                </th>
                                <td>
                                    {{ $user->email ?? '' }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ __('cruds.user.fields.role') }}
                                </th>
                                <td>
                                    <?php
                                        if(! optional($user->roles->first())->title){
                                            echo sprintf('<span class="badge bg-danger">%s</span>',__('cruds.user.fields.no_role'));
                                        }else{
                                            echo ($user->roles->first()->title == 'Admin') ?
                                                sprintf('<span class="badge bg-primary">%s</span>',$user->roles->first()->title) :
                                                sprintf('<span class="badge bg-success">%s</span>',$user->roles->first()->title);
                                        }
                                    ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
