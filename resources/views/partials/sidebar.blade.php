<div class="sidebar sidebar-dark sidebar-fixed" id="sidebar">
    <div class="sidebar-brand d-none d-md-flex">
        <img class="sidebar-brand-full" src="https://placehold.co/118x46.png" width="118" height="46" alt="Logo">
        <img class="sidebar-brand-narrow" src="https://placehold.co/46x46.png" width="46" height="46" alt="Logo">
    </div>
    <ul class="sidebar-nav simplebar-scrollable-y" data-coreui="navigation" data-simplebar="init">
        <div class="simplebar-wrapper" style="margin: 0px;">
            <div class="simplebar-mask">
                <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                    <div class="simplebar-content-wrapper" >
                        <div class="simplebar-content" style="padding: 0px;">

                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="nav-icon fas fa-tachometer-alt"></i>Dashboard</a>
                        </li>
                        @can('user_management_access')
                            <li class="nav-group"><a class="nav-link nav-group-toggle" href="#"><i class="nav-icon fas fa-users"></i>User</a>
                                <ul class="nav-group-items">
                                    @can('permission_management_access')
                                        <li class="nav-item"><a href="{{ route('admin.permissions.index') }}" class="nav-link {{ request()->routeIs('admin.permissions.*') ? 'active':'' }}"><i class="nav-icon fas fa-unlock-alt"></i></i>{{ __('cruds.permission.title') }}</a></li>
                                    @endcan
                                    @can('role_management_access')
                                        <li class="nav-item"><a href="{{ route('admin.roles.index') }}" class="nav-link {{ request()->routeIs('admin.roles.*') ? 'active':'' }}"><i class="nav-icon fas fa-briefcase"></i></i>{{ __('cruds.role.title') }}</a></li>
                                    @endcan
                                    @can('user_management_access')
                                        <li class="nav-item"><a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users.*') ? 'active':'' }}"><i class="nav-icon fas fa-user"></i>Users</a></li>
                                    @endcan
                                </ul>
                            </li>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </ul>
    <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>
  </div>
