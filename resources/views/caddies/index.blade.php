@extends('layouts.master')
@section('title')
    Listado de caddies
@endsection
@section('styles')
<link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<script src="{{asset('js/pages/admin/user.js')}}" type="text/javascript"></script>
<script>
    $('.toggle-class').on('change', function () {
      let data = {
          id: $(this).attr('id'),

          _token: $('input[name=_token]').val()
      };
      if ($(this).is(':checked')) {
          data.situacion = 1
      } else {
          data.situacion = 0
      }
      ajaxRequest($("#thisurl").val()+"/updateCaddies",data);

    });
        
    $('.delCad').on('click', function() {
      $(".delCad").attr("disabled", true);
      $(".loading-icon").addClass("fa fa-spinner fa-spin hide");
      $(".btn-txt").text("Eliminando...");
      let data = {
          id: $(this).attr('name'),

          _token: $('input[name=_token]').val()
      };
      ajaxRequest($("#thisurl").val()+"/delcad",data);
      setTimeout(() => { location.reload();}, 2000);

    });
    
</script>
@endsection

@section('content')

<div class="card table-responsive" style="background-color:  rgba(109, 109, 109, 0.5)">
    <div class="card-header text-lg-right justify-content-end">
        <button class="btn btn-primary" onclick="location.href = '{{ route('new_caddy') }}'"> <ion-icon name="add-outline"></ion-icon> Agregar caddy</button><br><br><br><br>
    </div>
    <div class="card-body">
            @csrf
        <div class="row">
            <table class="table table-bordered text-white">
                    <thead>
                      <tr>
                        <td>Nombre</td>
                        <td>Teléfono</td>
                        <td>Estatus</td>
                        <td>Acciones</td>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($caddy as $cads)
                      <tr>
                        <td>{{$cads->caddy_nombre}}</td>
                        <td>{{$cads->telefono}}</td>
                        <td>
                        <input type="checkbox" id="{{$cads->caddy_id}}" class="toggle-class checkbox" {{($cads->situacion ==1 )?'checked':''}} data-toggle="toggle" data-on="Activo" data-off="Inactivo" data-onstyle="success" data-offstyle="danger">
                        </td>
                        <td class="justify-content-center">
                            <button class="btn btn-default bg-light" title="Editar" onclick="location.href = '{{ route('editCad',['id'  => $cads->caddy_id] ) }}'" >
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" />
                                <path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" />
                                <line x1="16" y1="5" x2="19" y2="8" />
                              </svg>
                            </button>
                            {{-- onclick="location.href = '{{ route('delCad',['id'  => $cads->caddy_id] ) }}'" --}}
                            <button class="btn btn-default bg-danger" title="Eliminar" data-toggle="modal" data-target="#modalCenter{{$cads->caddy_id}}">
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <line x1="18" y1="6" x2="6" y2="18" />
                                <line x1="6" y1="6" x2="18" y2="18" />
                              </svg>
                            </button>
                        </td>
                      </tr>
                      <!-- Modal -->
                      <div class="modal fade" id="modalCenter{{$cads->caddy_id}}" tabindex="-1" role="dialog" aria-labelledby="ModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLongTitle">¿Está seguro que desea eliminar al Caddy?</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              El caddy <strong>{{$cads->caddy_nombre}}</strong> será eliminado.
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <button type="button" class="btn btn-danger delCad" name="{{$cads->caddy_id}}">
                                <i class="loading-icon"></i>
                                <span class="btn-txt">Eliminar</span>
                              </button>
                            </div>
                          </div>
                        </div>
                      </div>
                      @endforeach
                    </tbody>
            </table>
                 {{ $caddys->links() }}
        </div>
    </div><br><br>
</div><br><br><br><br><br><br>

@endsection
