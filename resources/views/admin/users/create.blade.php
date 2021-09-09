@extends('layouts.master')
@section('title')
    Agregar usuario
@endsection
@section('scripts')
<script src="{{asset('js/pages/admin/user.js')}}" type="text/javascript"></script>
@endsection
@section('content')
<div class="card">
    <form class="form-horizontal" action="{{route('save_user')}}" id="form_save_user" method="POST" >
        @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-8">
                                @include('admin.users.form')
                    </div>
                </div>
            </div>
            <div class="card-footer">
                    @include('layouts.form-save-button')
            </div>  
    </form>        
</div>
@endsection