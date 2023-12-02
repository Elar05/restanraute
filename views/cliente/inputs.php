<div class="form-group">
  <label for="documento">Documento</label>
  <div class="input-group">
    <input type="text" id="documento" name="documento" class="form-control" pattern="[0-9]+" minlength="8" maxlength="8" required>
    <div class="input-group-append">
      <button class="btn btn-primary" id="search_cliente"><i class="fa fa-search"></i> Buscar</button>
    </div>
    <div class="invalid-feedback">
      Documento es requerido y debe tener 8 digitos
    </div>
  </div>
</div>

<div class="form-group">
  <label for="nombres">Nombres</label>
  <input type="text" id="nombres" name="nombres" class="form-control" pattern="[A-Za-záéíóúÁÉÍÓÚñÑ ]+" required>
  <div class="invalid-feedback">
    Oh no! Nombres is invalid.
  </div>
</div>


<div class="form-group">
  <label for="email">Email</label>
  <input type="email" id="email" name="email" class="form-control" required>
  <div class="invalid-feedback">
    Oh no! Email is invalid.
  </div>
</div>

<div class="form-group">
  <label for="telefono">Teléfono</label>
  <input type="text" id="telefono" name="telefono" class="form-control" pattern="[0-9]+" required>
  <div class="invalid-feedback">
    Oh no! Teléfono is invalid.
  </div>
</div>

<div class="form-group">
  <label for="direccion">Dirección</label>
  <input type="text" id="direccion" name="direccion" class="form-control" pattern="[A-Za-z0-9 ]+" required>
  <div class="invalid-feedback">
    Oh no! Dirección is invalid.
  </div>
</div>