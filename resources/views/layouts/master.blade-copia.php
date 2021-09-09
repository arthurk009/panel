<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <link href="public/img/theme/logo.png" rel="icon">
  <title>{{ config('app.name', 'Courier') }}</title>
   <meta name="csrf-token" content="{{csrf_token()}}">
  <link rel="stylesheet" href="{{asset('css/app.css')}}">
  <link rel="stylesheet" href="{{asset('css/all.css')}}"> 
  {{-- <link rel="stylesheet" href="https://unpkg.com/@tabler/core@latest/dist/css/tabler.min.css"> --}}
  @yield("styles")
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper" id="app">
  <input type="hidden" value="{{url('/')}}" id="thisurl" name="thisurl">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-secondary navbar-light" style="background-color: #4682B4;">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto" >
      @include('layouts.notification')
      <li class="nav-item dropdown user-menu " >
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="true" >
              <img src="{{asset('img/theme/perfil.png')}}" class="user-image img-circle elevation-2" alt="User Image">
              <span class="d-none d-md-inline">{{\auth()->user()->name}}</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right " >
              <!-- User image -->
              <li class="user-header" style="background-color: #4682B4">
                <img src="{{asset('img/theme/perfil.png')}}" class="img-circle elevation-2" alt="User Image">
                  <p>{{\auth()->user()->getRoleNames()->first()}}</p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                    <a class="btn btn-default btn-flat float-right" href="{{ route('logout') }}"
                      onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                      {{ __('Logout') }}
                    </a>
                 <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                {{-- <a href="#" class="btn btn-default btn-flat float-right">Sign out</a> --}}
              </li>
            </ul>
          </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4" style="font-family: Arial, Helvetica, sans-serif" >
    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand-link">
      <img src="{{asset('img/theme/logo.png')}}" alt="{{ config('app.name', 'Courier') }}" class="brand-image img-circle elevation-3"
               style="opacity: .8">
          <span class="brand-text font-weight-light">{{ config('app.name', 'Courier') }}</span>
    </a>

   <!-- Sidebar -->
   <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2" >
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          @include('layouts.menu');
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4 class="m-0 text-dark">
                @yield('title')
            </h4>
          </div><!-- /.col -->
          <div class="col-sm-6">
              @include('layouts.breadcrumb')
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
      <!-- Main content -->
      <div class="content">
          <div class="container-fluid">
            <div class="row">
              <div class="col-lg-12">
                {{-- <div class="card"> --}}

                  {{-- <div class="card-body"> --}}

                    @yield('content')

                  {{-- </div> --}}
                {{-- </div> --}}
              </div>
            </div>
          </div><!-- /.container-fluid -->
        </div><!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @include('layouts.footer')

</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<script src="{{asset('js/app.js')}}"></script>
<script src="{{asset('js/all.js')}}"></script>

<script src="{{asset('js/functions.js')}}"></script> 
@yield("scripts")

@include('includes.messages')
</body>
</html>
