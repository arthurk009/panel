@extends('layouts.master')

@section('content')

<div class="container">
  <div class="card-body">
    <div class="form-group row">
      <div class="col-sm-3"></div>
      <div class="col-sm-6">
          <div class="card card-dark card-outline" >
              <div class="card-body box-profile" >
                <div class="text-center">
                  <h2>{{ config('app.name', 'Courier Manager') }}<h2>
                </div>
                <div class="text-center">
                   <img src="{{asset('img/theme/perfil.png')}}" alt="User Image" class="img-circle elevation-2">
                </div>
    
                <h3 class="profile-username text-center"> {{\auth()->user()->name}}</h3>
    
                <p class="text-muted text-center">{{\auth()->user()->getRoleNames()->first()}}</p>
    
                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <i class="fa fa-user-clock"></i> <b>Último inicio se sesión</b> <p class="float-right">{{\auth()->user()->last_login_at}}</p>
                  </li>
                  <li class="list-group-item">
                      <i class="fa fa-map-marker-alt"></i> <b>Logeado desde:</b> <p class="float-right">{{\auth()->user()->current_login_ip}}</p>
                  </li>
                </ul>
    
    
              </div>
              <!-- /.card-body -->
            </div>
    
      </div>
    </div>
</div>

@endsection
