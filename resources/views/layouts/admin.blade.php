<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
    <link href="https://cdn.jsdelivr.net/npm/@coreui/coreui@5.0.0-rc.0/dist/css/coreui.min.css" rel="stylesheet">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    @yield('styles')
  </head>
  <body>

    @include('partials.sidebar')

    <div class="wrapper d-flex flex-column min-vh-100 bg-light">
        <header class="header header-sticky mb-4">
          <div class="container-fluid">
            <button class="header-toggler px-md-0 me-md-3" type="button" onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
                <i class="icon icon-lg fas fa-bars"></i>
            </button>
            <ul class="header-nav d-none d-md-flex">
              <li class="nav-item"><a class="nav-link" href="#">Dashboard</a></li>
            </ul>
            <ul class="header-nav ms-auto"></ul>
            <ul class="header-nav ms-3">
              <li class="nav-item dropdown"><a class="nav-link py-0" data-coreui-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="icon icon-lg fas fa-user"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-end pt-0">
                  <div class="dropdown-header bg-light py-2">
                    <div class="fw-semibold">User</div>
                  </div>

                  <a class="dropdown-item" href="#"><i class="icon me-2 far fa-user"></i>Profile</a>

                  <div class="dropdown-divider"></div><a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logoutform').submit();"><i class="icon me-2 fas fa-sign-out-alt"></i>Logout</a>
                </div>
              </li>
            </ul>
          </div>
        </header>
        <div class="body flex-grow-1 px-3">
            <div class="container-lg">
                @if(session('message'))
                    <div class="row mb-2">
                        <div class="col-lg-12">
                            <div class="alert alert-success" role="alert">{{ session('message') }}</div>
                        </div>
                    </div>
                @endif

                @if($errors->count() > 0)
                    <div class="row mb-2">
                        <div class="col-lg-12">
                            <div class="alert alert-danger">
                                <ul class="list-unstyled">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>

                @endif

                @yield('content')

            </div>
            <form id="logoutform" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </div>
        <footer class="footer"></footer>
      </div>

    <script src="https://cdn.jsdelivr.net/npm/@coreui/coreui@5.0.0-rc.0/dist/js/coreui.bundle.min.js"></script>

    @yield('scripts')
  </body>
</html>
