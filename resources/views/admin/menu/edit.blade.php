@extends('layouts.master')
@section('title')
    Editar menú
@endsection
@section('scripts')
<script src="{{asset('js/pages/admin/menu.js')}}" type="text/javascript"></script>
@endsection
@section('content')
    {{-- Contenido  --}}
    <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-8">
        <form class="form-horizontal" action="{{route('update_menu',['id'=>$data->id])}}" id="form_guardar_menu" method="POST" >
            @csrf @method("put")
                @include('admin.menu.form')
                                
                @include('layouts.form-save-button')

        </form>


        </div>
    </div>
    {{-- //Contenido  --}}


@endsection