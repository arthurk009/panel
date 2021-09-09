<div class="card-body">
        <div class="form-group row">
            <label for="name" class="col-sm-3 col-form-label requerido">Nombre</label>
            <div class="col-sm-8">
            <input type="text" class="form-control" name="name" id="name" placeholder="Nombre" value="{{old('name', $data->name ?? '')}}" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="email" class="col-sm-3 col-form-label requerido">Email</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" name="email" id="email" placeholder="email" required value="{{old('email', $data->email ?? '')}}">
            </div>
        </div>
        <div class="form-group row">
                <label for="password" class="col-sm-3 col-form-label requerido">Password</label>
                <div class="col-sm-8">
                  <input type="password" class="form-control" name="password" id="password" placeholder="password" required>
                </div>
        </div>
        <div class="form-group row">
                <label for="password_confirmation" class="col-sm-3 col-form-label requerido">Repetir password</label>
                <div class="col-sm-8">
                  <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Repetir password" required >
                </div>
        </div>
        <div class="form-group row">
                <label for="role" class="col-sm-3 col-form-label requerido">Rol</label>
                <div class="col-sm-8">
                  <select name="role" id="role" class="form-control">
                        <option value="">--Seleccione Rol--</option>
                        @foreach ($comboRoles as $idRole => $roleName)
                            <option value="{{$idRole}}"  {{ ( (old("role", $data->roleId ?? '')   ) == $idRole ? "selected":"") }}>{{$roleName}}</option>
                        @endforeach

                  </select>  
                  
                </div>
        </div>

      
</div>
