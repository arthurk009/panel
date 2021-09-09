<div class="card-body">
        <div class="form-group row">
            <label for="nombre" class="col-lg-2 col-form-label requerido">Nombre</label>
            <div class="col-sm-9">
            <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre" value="{{old('nombre', $data->nombre ?? '')}}" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="url" class="col-sm-2 col-form-label requerido">Url</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="url" id="url" placeholder="Url" required value="{{old('url', $data->url ?? '')}}">
            </div>
        </div>
        <div class="form-group row">
            <label for="icono" class="col-sm-2 col-form-label requerido">Icono</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="icono" id="icono" placeholder="Icono" required value="{{old('icono', $data->icono ?? '')}}">
            </div>
            <div class="col-sm-1">
            <span id="mostrar-icono" class="fa fa-fw {{old("icono")}}"></span>
            </div>
        </div>

</div>
