@extends('layouts.master')
@section('titulo')
    Crear menú
@endsection

@section('scripts')
<script src="{{asset('js/pages/admin/roleMenu.js')}}" type="text/javascript"></script>
@endsection

@section('content')
    
{{-- Contenido  --}}
<div class="card">
    
    <div class="card-body">
        <div class="row">
                <div class="col-lg-12">
                    
                            @csrf
                            <table class="table table-striped table-bordered table-hover" id="tabla-data">
                                <thead>
                                    <tr>
                                        <th>Menú</th>
                                        @foreach ($roles as $id => $nombre)
                                        <th class="text-center">{{$nombre}}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($menus as $key => $menu)
                                    @if ($menu["menu_id"] != 0)
                                        @break
                                    @endif
                                        <tr>
                                            <td class="font-weight-bold"><i class="fa fa-arrows-alt"></i> {{$menu["nombre"]}}</td>
                                            @foreach($roles as $id => $nombre)
                                                <td class="text-center">
                                                    <input
                                                    type="checkbox"
                                                    class="menu_rol"
                                                    name="menu_rol[]"
                                                    data-menuid={{$menu[ "id"]}}
                                                    value="{{$id}}" {{in_array($id, array_column($menuRoles[$menu["id"]], "id"))? "checked" : ""}}>
                                                </td>
                                            @endforeach
                                        </tr>

                                        @foreach($menu["submenu"] as $key => $hijo)
                                            <tr>
                                                <td class="pl-4"><i class="fa fa-arrow-right"></i> {{ $hijo["nombre"] }}</td>
                                                @foreach($roles as $id => $nombre)
                                                    <td class="text-center">
                                                        <input
                                                        type="checkbox"
                                                        class="menu_rol"
                                                        name="menu_rol[]"
                                                        data-menuid={{$hijo[ "id"]}}
                                                        value="{{$id}}" {{in_array($id, array_column($menuRoles[$hijo["id"]], "id"))? "checked" : ""}}>
                                                    </td>
                                                @endforeach
                                            </tr>
                                            @foreach ($hijo["submenu"] as $key => $hijo2)
                                                <tr>
                                                    <td class="pl-5"><i class="fa fa-arrow-right"></i> {{$hijo2["nombre"]}}</td>
                                                    @foreach($roles as $id => $nombre)
                                                        <td class="text-center">
                                                            <input
                                                            type="checkbox"
                                                            class="menu_rol"
                                                            name="menu_rol[]"
                                                            data-menuid={{$hijo2[ "id"]}}
                                                            value="{{$id}}" {{in_array($id, array_column($menuRoles[$hijo2["id"]], "id"))? "checked" : ""}}>
                                                        </td>
                                                    @endforeach
                                                </tr>
                                                @foreach ($hijo2["submenu"] as $key => $hijo3)
                                                    <tr>
                                                        <td class="pl-5"><i class="fa fa-arrow-right"></i> {{$hijo3["nombre"]}}</td>
                                                        @foreach($roles as $id => $nombre)
                                                        <td class="text-center">
                                                            <input
                                                            type="checkbox"
                                                            class="menu_rol"
                                                            name="menu_rol[]"
                                                            data-menuid={{$hijo3[ "id"]}}
                                                            value="{{$id}}" {{in_array($id, array_column($menuRoles[$hijo3["id"]], "id"))? "checked" : ""}}>
                                                        </td>
                                                        @endforeach
                                                    </tr>
                                                @endforeach
                                            @endforeach
                                        @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                    
                </div>
        </div> 
    </div>    
        {{-- //Contenido  --}}
</div>

@endsection