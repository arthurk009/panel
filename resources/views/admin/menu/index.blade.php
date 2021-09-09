@extends('layouts.master')
@section('title')
    Listado menú
    @endsection

    @section('styles')
    <link rel="stylesheet" href="{{asset('css/jquery-nestable/jquery.nestable.css')}}">
    @endsection
    
    @section('scripts')
    <script src="{{asset('js/jquery-nestable/jquery.nestable.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/jquery-nestable/index.js')}}" type="text/javascript"></script>
    @endsection


@section('content')
<div class="card">    
    <div class="card-body">
        <div class="row">
                @csrf
                        <div class="dd" id="nestable">
                                <ol class="dd-list">
                                    @foreach($menus as $key => $item)
                                        @if($item['menu_id'] != 0)
                                            @break
                                        @endif
                                        @include("admin.menu.menu-item",["item" => $item])
                                    @endforeach                                
                                </ol>
                        </div>
        </div>
    </div>
</div>
@endsection