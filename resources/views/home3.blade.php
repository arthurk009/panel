@extends('layouts.master')

@section('content')
<link rel="stylesheet" href="{{asset('css/boxes.css')}}">

<div class="row">


  <div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-xs-3 col-sm-6 mb-3">
        <!-- small box -->
        <div class="small-box bg-info">
          <div class="inner">
            <h4 class="card-title text-white"> {{\auth()->user()->name}}</h4>
            <p class="card-text text-white">{{\auth()->user()->getRoleNames()->first()}}</p>
          </div>
          <div class="icon">
            <i class="ion ion-person"></i>
          </div>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-xs-3 col-sm-6 mb-3">
        <!-- small box -->
        <div class="small-box bg-success">
          <div class="inner">
            <h4 class="card-title text-white">{{$cuenta}}</h4>
            <p class="card-text text-white">Jugadores en el campo</p>
          </div>
          <div class="icon">
            <i class="ion ion-ios-people"></i>
          </div>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-xs-3 col-sm-6 mb-3">
        <!-- small box -->
        <div class="small-box bg-warning">
          <div class="inner">
            <h4 class="card-title text-white">{{$temp_c}}°</h4>
            <p class="card-text text-white">Madeiras Country Club</p>
          </div>
          <div class="icon">
            <i class="ion ion-ios-partlysunny"></i>
          </div>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-xs-3 col-sm-6 mb-3">
        <!-- small box -->
        <div class="small-box bg-danger">
          <div class="inner">
            <h4 class="card-title text-white">{{$day}}</h4>
            <p class="card-text text-white">{{$dia_mes}} de {{$mes}} del {{$año}}</p>
          </div>
          <div class="icon">
            <i class="ion ion-android-calendar"></i>
          </div>
        </div>
      </div>
      <!-- ./col -->
    </div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

@endsection 
