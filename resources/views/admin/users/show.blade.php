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
            <h6>{{ __('global.show') }} {{ __('cruds.user.title') }}</h6>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-end mb-1">
                @can('user_management_edit')
                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-info text-light float-end me-1"><i class="fas fa-edit"></i></a>
                @endcan
                @can('user_management_delete')
                    <button type="submit" class="btn btn-sm btn-danger text-light float-end" onclick="if (confirm('{{ __('global.areYouSure') }}') == true){ event.preventDefault(); document.getElementById('form-user-delete-{{ $user->id }}').submit(); }">
                        <i class="fas fa-trash"></i>
                    </button>
                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" id="form-user-delete-{{ $user->id }}" class="d-none">
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
                                {{ __('cruds.user.fields.role_id') }}
                            </th>
                            <td>
                                <?php
                                    if(! optional($user->roles->first())->title){
                                        echo sprintf('<span class="badge bg-danger">%s</span>',__('cruds.user.fields.no_role_id'));
                                    }else{
                                        echo (optional($user->roles->first())->id == 1) ?
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
@endsection





















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
