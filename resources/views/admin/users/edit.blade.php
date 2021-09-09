@extends('layouts.master')
@section('title')
    Editar usuario
@endsection
@section('scripts')
<script src="{{asset('js/pages/admin/user.js')}}" type="text/javascript"></script>
@endsection
@section('content')
<div class="card">
    <form class="form-horizontal" action="{{route('update_user',['id'=>$data->id])}}" id="form_save_user" method="POST" >
        @csrf @method("put")
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