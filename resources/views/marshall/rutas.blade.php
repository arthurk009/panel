@extends('layouts.master')

@section('title')
    Rutas
@endsection

@section('scripts')
<style>
    #map {
        height: 700px;
    }
</style>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBnsjrdw9ZE6Vm1TRd4IwLQGplaD-I5B80&callback=initMap2"></script>

<script type="text/javascript">
    var ubicacionesFijas = {!! json_encode($ubicaciones->toArray()) !!};
    var markers = [];
    var map;
    var flightPath = [];
    const labels = ["1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19"];


        function initMap2() {
            map = new google.maps.Map(document.getElementById('map'), {
                zoom: 17,
                fullscreenControl: true,
                disableDefaultUI: true,
                mapTypeId: 'satellite',
                center:{lat:19.614270, lng: -99.268847} //Madeiras
        });

        // itera sobre las ubicaciones fijas
        for (var i = 0; i < ubicacionesFijas.length; i++) {
            var urlimg = $("#thisurl").val()+"/img/golf_simple.png";
            var marker = new google.maps.Marker({
                position: new google.maps.LatLng(parseFloat(ubicacionesFijas[i].latitud), parseFloat(ubicacionesFijas[i].longitud)),
                map: map,
                icon: urlimg,
                label: {text: labels[i], color: "white"},
            });

            markers.push(marker);

        }
      }

    $( document ).ready(function() {
        $("#dispositivo_id").on('change',function(){
            if($("#dispositivo_id").val() !=''){
                var page = new Date().getTime();
                var polylines = [];
                var urlEnvia = "{{route('rutas_track')}}";
                $.ajax({
                    url: urlEnvia,
                    dataType: 'json',
                    data: {dispositivo_id: $("#dispositivo_id").val()},
                    async: false,
                    success: function(neighborhoods){

                        // console.log(flightPath.length);
                        // console.log(flightPath);
                        if(flightPath.length !==0){
                            flightPath.setMap(null);
                        }

                        clearMarkers();

                       $("#fechaIni").html(neighborhoods['info'].fecha_registro);
                        $("#fechaFin").html(neighborhoods['info'].fecha_fin);
                        var flightPlanCoordinates = neighborhoods['polylines'];
                        flightPath = new google.maps.Polyline({
                        path: flightPlanCoordinates,
                        geodesic: true,
                        strokeColor: '#FF0000',
                        strokeOpacity: 1.0,
                        strokeWeight: 2
                        });

                        flightPath.setMap(map);
                        for (var i = 0; i < neighborhoods['datos'].length; i++){
                            addMarkerWithTimeout(neighborhoods['datos'][i]);
                        }
                    }
                });
            }else{
                clearMarkers();
                flightPath.setMap(null);
            }

        });

    });


    function addMarkerWithTimeout(position) {
            var contentString = '<div id="content">'+
                '<div id="siteNotice">'+
                '</div>'+
                '<div id="bodyContent">'+
                '<p><b>Fecha / Hora: </b>'+position.created_at+
                '</div>'+
                '</div>';
            var imagen = (parseInt(position.estatus)==0)?$("#thisurl").val()+"/img/0370007211.png":$("#thisurl").val()+"/img/mark2.png";
            var infowindow = new google.maps.InfoWindow({
            content: contentString
            });


                var marker = new google.maps.Marker({
                    position: new google.maps.LatLng(parseFloat(position.latitud), parseFloat(position.longitud)),
                    map: map,
                    icon: imagen,
                });
                marker.addListener('click', function() {
                infowindow.open(map, marker);
                });
                markers.push(marker);

        }

        function clearMarkers() {

            for (var i = parseInt(ubicacionesFijas.length); i <= parseInt(markers.length)-parseInt(1); i++) {
            markers[i].setMap(null);
            }


    }

</script>

@endsection


@section('content')




<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <form class="form-inline" action="/action_page.php">
                <label for="email" class="col-md-2 pb-2 text-white">Seleccione jugador</label>
                <select name='dispositivo_id' id='dispositivo_id' class='form-control col-md-4'>
                    <option class="form-control" value=''  selected>Seleccione Dispositivo</option>
                    @foreach ($comboDispositivos as $disp)
                        <option value='{{$disp->dispositivo_id}}-{{$disp->registro_id}}'>{{$disp->persona}}</option>
                    @endforeach
                </select>
                <label for="pwd" class="col-md-2 px-2 py-3 text-white">Hora Entrada: </label>
                <i class="control-label col-md-1 px-4" id="fechaIni"></i>
                <label for="pwd" class="col-md-2 text-white">Hora Salida: </label>
                <i class="control-label col-md-1 px-2 py-3" id="fechaFin"></i>
            </form>
        </div>

        <div id="map"></div>

    </div>


</div>


@endsection
