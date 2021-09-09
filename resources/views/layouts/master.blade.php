<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>

    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <link href="public/img/theme/logo.png" rel="icon">
    <title>{{ config('app.naresources/views/caddies/new.blade.phpme', 'GOLF-FLOW') }}</title>
    <meta name="csrf-token" content="{{csrf_token()}}">
    <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link href="{{ asset('css/tabler.min.css') }}" rel="stylesheet"/>

    <link rel="stylesheet" href="{{asset('css/all.css')}}">
  </head>

  <style>
    .bg-image{
      background: url('{{ asset('img/home/fondo.png') }}') no-repeat center center fixed;
      -webkit-background-size: cover;
      -moz-background-size: cover;
      -o-background-size: cover;
      background-size: cover;
    }
    .breadcrumb-item + .breadcrumb-item::before {
        display: inline-block;
        padding-right: 0.5rem;
        color: #ffffff;
        content: "/";
        }
  </style>

  <body class="antialiased bg-image">

    <div class="wrapper ">
      <input type="hidden" value="{{url('/')}}" id="thisurl" name="thisurl">

      <header class="navbar navbar-expand-md navbar-dark d-print-none">
        <div class="container-xl">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
            <span class="navbar-toggler-icon"></span>
          </button>
          <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
            <a href=".">
              <img src="{{ asset('img/home/logo.png') }}" width="50" height="50"  >
            </a>
          </h1>
          <div class="navbar-nav flex-row order-md-last">

            <div class="nav-item dropdown">
              <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
                <img src="{{ asset('img/home/icon.png') }}" width="110" height="32" alt="Tabler" class="navbar-brand-image">
                <div class="d-none d-xl-block ps-2">
                  <div>{{\auth()->user()->name}}</div>
                  <div class="mt-1 small text-muted">{{\auth()->user()->getRoleNames()->first()}}</div>
                </div>
              </a>
              <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                {{-- <a href="#" class="dropdown-item">Settings</a> --}}
                <a href="{{route('logout')}}" class="dropdown-item" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">{{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
              </form>
              </div>
            </div>
          </div>
          <div class="collapse navbar-collapse" id="navbar-menu">
            <div class="d-flex flex-column flex-md-row flex-fill align-items-stretch align-items-md-center">
              <ul class="navbar-nav">

                @include('layouts.menu')

              </ul>
            </div>
          </div>
        </div>
      </header>
      <div class="page-wrapper">

        <div class="container-xl">
          <!-- Page title -->
          <div class="page-header d-print-none">
            <div class="row align-items-center">
              <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                  {{-- Menu --}}
                </div>
                <h2 class="page-title text-white">
                  @yield('title')
                </h2>
              </div>
              <!-- Page title actions -->
              <div class="col-auto ms-auto d-print-none text-white">
                <div class="btn-list">
                  <span class="d-none d-sm-inline">
                    @include('layouts.breadcrumb')
                  </span>

                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="page-body">
			<div class="container-xl">
				<div class="col-12">
					<div class="row">
					<!--
					  <div class="card-header">
						<h3 class="card-title">Invoices</h3>
					  </div>
					-->
					  <div class="border-bottom py-3">
						{{-- <div class="d-flex"> --}}
              @yield('content')
						{{-- </div> --}}
					  </div>
					</div>
				</div>
			</div>
        </div>

        @include('layouts.footer')

      </div>
    </div>

    <!-- Libs JS -->
    <script src="{{ asset('libs/apexcharts/dist/apexcharts.min.js') }}"></script>
    <!-- Tabler Core -->
    <script src="{{ asset('js/tabler.min.js') }}"></script>
    <script src="{{asset('js/app.js')}}"></script>
    <script src="{{asset('js/all.js')}}"></script>
    <script src="{{asset('js/functions.js')}}"></script>
    @yield("scripts")
    @include('includes.messages')
  </body>

  <script>
    $(document).ready(function(){

      function iniciar()
      {
        let ajax = new XMLHttpRequest();

        ajax.open("GET", "{{route('peticiones')}}", true);
        ajax.send();

        ajax.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                let data = JSON.parse(this.responseText);
                console.log(data);
                let html = ' ';

                document.getElementById("solicitudes").innerHTML = '';

                html = data;

                if ( html == 0 ) {
                  html = '';
                  $("#solicitudes").hide();
                }
                if(html >0){
                  $("#solicitudes").show();
                }

                document.getElementById("solicitudes").innerHTML += html;
            }
        }
      }
      iniciar();
      setInterval(iniciar, 45000);
    });
  </script>

</html>
