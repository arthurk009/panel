@extends('layouts.master')
@section('title')
    Crear menú
@endsection
@section('scripts')
<script src="{{asset('js/pages/admin/menu.js')}}" type="text/javascript"></script>
@endsection
@section('content')
    {{-- Contenido  --}}

    <div class="card">
        <form class="form-horizontal" action="{{route('save_menu')}}" id="form_guardar_menu" method="POST" >
        @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-8">

                                @include('admin.menu.form')





                    </div>
                </div>
            </div>
            <div class="card-footer">
                    @include('layouts.form-save-button')
            </div>
    </form>
    </div>
    {{-- //Contenido  --}}


@endsection
