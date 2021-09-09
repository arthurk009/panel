@extends('layouts.master')
@section('title')
    Mapa 1
@endsection
@section('scripts')
<style>
    /* Set the size of the div element that contains the map */
    #map {
        height: 600px;
    }
    #over_map { position: absolute; top: 10px; left: 10px; z-index: 99; }
 </style>
@endsection
@section('content')

<body>
    <form class="form-horizontal" data-route="{{route('getInterval')}}" id="getInterval" method="POST" >
        @csrf
        <div id="map"></div>
            <script>
                var ubicacionesFijas = {!! json_encode($ubicaciones->toArray()) !!};
                var ubicacionesIniciales = {!! json_encode($ubicacionesInicial) !!};
                // console.log(ubicacionesIniciales);
                var markers = [];
                var infoWindows = [];
                var map;
                const labels = ["1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19"];

                
                function initMap() {
                    map = new google.maps.Map(
                    document.getElementById('map'), {
                        zoom: 17.3,
                        disableDefaultUI: true,
                        mapTypeId: 'satellite',
                        fullscreenControl: true,
                        fullscreenControlOptions: {
                                position: google.maps.ControlPosition.LEFT_CENTER
                        },
                        center:{lat:19.613804, lng: -99.269531}
                    });

                    for (var i = 0; i < ubicacionesFijas.length; i++) {
                        //urlimg = $("#thisurl").val()+"/img/golf_simple.png";
			//urlimg = "{{ asset("img/golf_simple.png") }}";
urlimg = "{{ asset('/img/golf_simple.png') }}";

                        var marker = new google.maps.Marker({
                            position: new google.maps.LatLng(parseFloat(ubicacionesFijas[i].latitud), parseFloat(ubicacionesFijas[i].longitud)),
                            map: map,
                            icon: urlimg,
                            label: {text: labels[i], color: "white"},
                        });
                        markers.push(marker);
                    }


                    for (var i = 0; i < ubicacionesIniciales.length; i++) {
                    
                    var bateria= parseInt(ubicacionesIniciales[i].bateria); 
                    var imgBateria="";
                    if(parseInt(bateria) >80){
                        imgBateria="battery_100.png";
                    }
                    if(parseInt(bateria) <=80 && parseInt(bateria) >60){
                        imgBateria="battery_80.png";
                    }
                    if(parseInt(bateria) <=60 && parseInt(bateria) >40){
                        imgBateria="battery_60.png";
                    }
                    if(parseInt(bateria) <=40 && parseInt(bateria) >20){
                        imgBateria="battery_40.png";
                    }
                    if(parseInt(bateria) <=20){
                        imgBateria="battery_20.png";
                    }

                    var contentString = '<div id="content" style="padding-top:-10px; margin-top:0px; margin-button:-5px;">'+
                            '<div id="siteNotice">'+
                            '</div>'+
                            '<b>'+ubicacionesIniciales[i].nombre+'</b>'+
                            '<b>('+bateria+'%)</b>'
                            //'<img src="img/'+imgBateria+'" height="21px">'
                            '<div id="bodyContent">'+
                            /*'<p><b>Fecha Hora Registro: </b>'+ubicacionesIniciales[i].fecha_registro+*/
                            '</div>'+
                            '</div>'; 

                        infowindow = new google.maps.InfoWindow({
                        content: contentString,
                        disableAutoPan: true
                    });


                    var marker = new google.maps.Marker({
                        position: new google.maps.LatLng(parseFloat(ubicacionesIniciales[i].latitud), parseFloat(ubicacionesIniciales[i].longitud)),
                        map: map,
                        //icon: $("#thisurl").val()+"/img/"+ubicacionesIniciales[i].imagen+'.png',
			icon : "{{ asset('/img/') }}"+"/"+ubicacionesIniciales[i].imagen+'.png',

                    });
                        
                        google.maps.event.addListener(marker, 'click', (function (infowindow) {
                            return function () {
                                infowindow.open(map, this);
                            }
                        })(infowindow));
                        infowindow.open(map,marker);
                        infoWindows.push(infowindow);
                        markers.push(marker);
                }
                }

                setInterval(function () {
                var page = new Date().getTime();
                var urlInterval = $("#getInterval").data("route");

                console.log(urlInterval);
                    $.ajax({ 
                        url: urlInterval, 
                        dataType: 'json', 
                        data: {page: page},
                        async: false, 
                        success: function(neighborhoods){
                            console.log(neighborhoods);
                            if(neighborhoods !== null){
                                clearMarkers();
                                for (var i = 0; i < neighborhoods.length; i++) {
                                addMarkerWithTimeout(neighborhoods[i], i * 200);
                                }
                                
                            }else{
                            clearMarkers();
                            }
                            
                        } 
                    });
                },10000);

            
                function addMarkerWithTimeout(position) {
                
                    var bateria= parseInt(position.bateria); 
                    var imgBateria="";
                    if(parseInt(bateria) >80){
                        imgBateria="battery_100.png";
                    }
                    if(parseInt(bateria) <=80 && parseInt(bateria) >60){
                        imgBateria="battery_80.png";
                    }
                    if(parseInt(bateria) <=60 && parseInt(bateria) >40){
                        imgBateria="battery_60.png";
                    }
                    if(parseInt(bateria) <=40 && parseInt(bateria) >20){
                        imgBateria="battery_40.png";
                    }
                    if(parseInt(bateria) <=20){
                        imgBateria="battery_20.png";
                    }

                    var contentString = '<div id="content">'+
                    '<div id="siteNotice">'+
                    '</div>'+
                    '<b>'+position.nombre+'</b>'+
                    '<b>('+bateria+'%)</b>'
                    //'<img src="img/'+imgBateria+'">'
                    '<div id="bodyContent">'+
                    /*'<p><b>Fecha Hora Registro: </b>'+position.fecha_registro+*/
                    '</div>'+
                    '</div>'; 

                    var infowindow = new google.maps.InfoWindow({
                    content: contentString,
                    disableAutoPan: true
                    });




                    var marker = new google.maps.Marker({
                        position: new google.maps.LatLng(parseFloat(position.latitud), parseFloat(position.longitud)),
                        map: map,
                        icon: 'img/'+position.imagen+'.png',
                    });
                    marker.addListener('click', function() {
                    infowindow.open(map, marker);
                    });
                    infowindow.open(map,marker);
                    infoWindows.push(infowindow);
                    markers.push(marker);

                    }

                    function clearMarkers() {
                    console.log(markers);
                    if (markers) {
                        for (var i = parseInt(ubicacionesFijas.length); i < markers.length; i++) {
                            markers[i].setMap(null);
                    //                  markers.pop();
                        }
                        markers.length = parseInt(ubicacionesFijas.length);
                    }

                    //console.log(markers);
                    }
            </script>
        </div>
    </form>
</body>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDHzavUnIQjjZgs3YLyKEzrOLasDWiFNec&callback=initMap"> </script>
    
@endsection
