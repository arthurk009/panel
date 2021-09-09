@extends('layouts.master')

@section('title')
    Solicitudes Mapa 2
@endsection


@section('scripts')
<script type="application/javascript">
    $(document).ready(function () {

        $('#map').on('click', '.enviaPedido', function() {
                    var idsos=$(this).attr("idsos");
                    var page = new Date().getTime();
                    var urlEnvia = "{{route('enviaPedido')}}";
                    var boton = $(this);
                    $.ajax({
                        url: urlEnvia,
                        dataType: 'json',
                        data: {page: page, idsos:idsos},
                        async: false,
                        success: function(datos){
                            if(datos == true)
                            {
                                $('#content').hide();
                                infowindow.close();
                            }
                        }
                    });

                });
            });
</script>
<style>
    #map {
        height: 680px;
    }
    #over_map {
        position: absolute;
        top: 10px;
        left: 10px;
        z-index: 99; }
</style>
@endsection

@section('content')

<body>
    <form class="form-horizontal" data-route="{{route('getUbicacionesMapaCarCombine')}}" id="getInterval" method="POST" >
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
                        center:{lat:19.620063, lng: -99.264052} //Madeiras
                    });

                    for (var i = 0; i < ubicacionesFijas.length; i++) {
                        urlimg = $("#thisurl").val()+"/img/golf_simple.png";
                        var marker = new google.maps.Marker({
                            position: new google.maps.LatLng(parseFloat(ubicacionesFijas[i].latitud), parseFloat(ubicacionesFijas[i].longitud)),
                            map: map,
                            icon: urlimg,
                            label: {text: labels[i], color: "white"},
                        });
                        markers.push(marker);
                    }


                    for (var i = 0; i < ubicacionesIniciales.length; i++) {
                        console.log(ubicacionesIniciales[i])

                        var fechaS=ubicacionesIniciales[i].fecha_solicitud;
                            contentString = '<div id="content">'+
                                            '<div id="siteNotice">'+
                                            '</div>'+
                                            '<h4 id="firstHeading" class="firstHeading">'+ubicacionesIniciales[i].nombre+'</h4>'+
                                            '<div id="bodyContent">'+
                                            //'<p><b>Preferencia de Bebidas: </b>'+ubicacionesIniciales[i].bebidas+
                                            '<p><b>Solicitud: '+fechaS.substr(-8)+
                                            //'<p><b>Caddie: '+ubicacionesIniciales[i].caddie+
                                            '</b><p> <button type="button" idsos="'+ubicacionesIniciales[i].id_dispositivo_ubicacion_sos+'" class="btn btn-primary btn-sm enviaPedido">Atendido</button> </b>'+
                                            '</div>'+
                                            '</div>';

                        infowindow = new google.maps.InfoWindow({
                        content: contentString,
                        disableAutoPan: true
                        });


                        var marker = new google.maps.Marker({
                            position: new google.maps.LatLng(parseFloat(ubicacionesIniciales[i].latitud), parseFloat(ubicacionesIniciales[i].longitud)),
                            map: map,
                            icon: $("#thisurl").val()+'/img/golf_icon4.png',
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
                    $.ajax({
                        url: urlInterval,
                        dataType: 'json',
                        data: {page: page},
                        async: false,
                        success: function(neighborhoods){
                            clearMarkers();
                                for (var i = 0; i < neighborhoods.length; i++) {
                                addMarkerWithTimeout(neighborhoods[i]);
                                }
                        }
                    });
                },10000);

                // setInterval(function () {
                // var page = new Date().getTime();
                // var urlInterval = $("#getInterval").data("route");

                // console.log(urlInterval);
                //     $.ajax({
                //         url: urlInterval,
                //         dataType: 'json',
                //         data: {page: page},
                //         async: false,
                //         success: function(neighborhoods){
                //             console.log(neighborhoods);
                //                 clearMarkers();

                //                 for (var i = 0; i < neighborhoods.length; i++) {
                //                 addMarkerWithTimeout(neighborhoods[i], i * 200);
                //                 }

                //         }
                //     });
                // },60000);


                function addMarkerWithTimeout(position) {
                    console.log(position);

                    if(position.tipo =='0'){
                        var fechaS=position.fecha_solicitud;
                        var contentString = '<div id="content">'+
                                            '<div id="siteNotice">'+
                                            '</div>'+
                                            '<h4 id="firstHeading" class="firstHeading"> '+position.nombre+'</h4>'+
                                            '<div id="bodyContent">'+
                                //          '<p><b>Preferencia de Bebidas: </b>'+position.bebidas+
                                            '<p><b>Solicitud:'+fechaS.substr(-8)+
                                            //'<p><b>Caddie: '+position.caddie+
                                            '</b><p> <button type="button" idsos="'+position.id_dispositivo_ubicacion_sos+'" class="btn btn-primary btn-sm enviaPedido">Atendido</button> </b>'+
                                            '</div>'+
                                            '</div>';
                        var icono= $("#thisurl").val()+'/img/golf_icon4.png';
                    }else{
                        contentString = '<div id="content">'+
                                        '<div id="siteNotice">'+
                                        '</div>'+
                                        '<h4 id="firstHeading" class="firstHeading">'+position.nombre+'</h4>'+
                                        '<div id="bodyContent">'+
                                        '</div>'+
                                        '</div>';
                        var icono= $("#thisurl").val()+'/img/golfcar.png';
                        console.log(icono);
                    }


                    var infowindow = new google.maps.InfoWindow({
                    content: contentString,
                    disableAutoPan: true
                });




                    var marker = new google.maps.Marker({
                        position: new google.maps.LatLng(parseFloat(position.latitud), parseFloat(position.longitud)),
                        map: map,
                        icon: icono,
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
                            for (var i = 0; i < infoWindows.length; i++) {
                                infoWindows[i].close();
                            }
                                infoWindows = [];
                    }


                }

                //$(document).on('click', '.enviaPedido', function() {
                // $('#map').on('click', '.enviaPedido', function (e) {
                //     alert("aquii");
                    // var idsos=$(this).attr("idsos");
                    // var page = new Date().getTime();
                    // var urlEnvia = "{{route('enviaPedido')}}";
                    // var boton = $(this);
                    // $.ajax({
                    //     url: urlEnvia,
                    //     dataType: 'json',
                    //     data: {page: page, idsos:idsos},
                    //     async: false,
                    //     success: function(datos){
                    //     if(datos)
                    //     boton.hide();

                    //     }
                    // });

                // });
            </script>

        </div>
    </form>
</body>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDHzavUnIQjjZgs3YLyKEzrOLasDWiFNec&callback=initMap"></script>

@endsection
