@extends('layouts.master')
@section('title')
    Listado de usuarios
@endsection
@section('styles')
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
<script src="{{asset('js/pages/admin/user.js')}}" type="text/javascript"></script>
@endsection


@section('content')
<div class="card">
    <div class="card-header text-lg-right">
        <button class="btn btn-primary" onclick="location.href = '{{ route('create_user') }}'"> <i class="fa fa-plus"></i> Agregar usuario</button>
    </div>    
    <div class="card-body">
            @csrf
        <div class="table-responsive">    
            <table class="table table-bordered">
                    <thead>                  
                      <tr>
                        <th>Usuario</th>
                        <th>Email</th>
                        <th>Rol</th>
                        <th>Estatus</th>
                        <th>Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($users as $user)
                      <tr>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->roleName}}</td>
                        <td>
                        <input type="checkbox" id="{{$user->id}}" class="user_status" {{($user->status ==1)?'checked':''}} data-toggle="toggle" data-on="Activo" data-off="Inactivo" data-onstyle="success" data-offstyle="danger">
                        </td>
                        <td>
                            <button class="btn btn-default btn-brdr" title="Editar" onclick="location.href = '{{ route('edit_user',['id'  => $user->id] ) }}'" ><i class="fa fa-edit"></i></button>
                        </td>
                      </tr>
                          
                      @endforeach
                    </tbody>
            </table>
                 {{$users->links()}} 
        </div>         
    </div>
</div>
@endsection