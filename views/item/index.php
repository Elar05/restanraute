<?php require_once 'views/layout/head.php'; ?>

<link rel="stylesheet" href="<?= URL ?>/public/bundles/datatables/datatables.min.css">
<link rel="stylesheet" href="<?= URL ?>/public/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">

<?php require_once 'views/layout/header.php'; ?>

<!-- Contenido del main -->
<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">

                            <!-- TITULO -->
                            <h4>Lista de Items</h4>

                            
                            <!-- BOTON "+ AGREGAR" -->
                            <button type="button" class="btn btn-primary" id="add_cliente" data-toggle="modal"
                                data-target="#modal_cliente">
                                <i class="fa fa-plus"></i> Agregar</button>
                        </div>

                        
                        <!-- TABLA DE ITEMS -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped w-100" id="table_cliente">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th >Categoria</th>
                                            <th>Tipo</th>
                                            <th>Precio de compra</th>
                                            <th>Precio de venta</th>
                                            <th>Stock</th>
                                            <th>Stock Min</th>
                                            <th>Descripcion</th>
                                            <th>Fecha de Registro</th>
                                            <th>Estado</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    
    <!-- FORMULARIO DE NUEVO ITEM -->

    <div class="modal fade" id="modal_cliente" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Formulario Nuevo Items</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form id="form_cliente" method="post" novalidate>

                        <!-- Categoria -->
                        <div class="form-group">
                            <label for="idcategoria">Categoria</label>
                            <br>
                            <select name="idcategoria">
                                <option value="1">Postre</option>
                                <option value="2">Bebida</option>
                                <option value="3">Segundo</option>
                            </select>
                        </div>
                        
                        <!-- Tipo -->
                        <div class="form-group">
                            <label for="tipo">Tipo</label>
                            <input type="text" id="tipo" name="tipo" class="form-control input_cliente" required>
                            <div class="invalid-feedback">
                                El tipo es requerido. Ingrese un valor valido
                            </div>                        </div>

                        <!-- Precio C -->
                        <div class="form-group">
                            <label for="precio_c">Precio de Compra</label>
                            <input type="number" id="precio_c" name="tipo" min="0" 
                            placeholder="S/."
                            class="form-control input_cliente" required>
                            <div class="invalid-feedback">
                                Ingrese un precio valido
                            </div>
                        </div>
                        
                        <!-- Precio V -->
                        <div class="form-group">
                            <label for="precio_v">Precio de venta</label>
                            <input type="number" id="precio_v" name="precio_v" min="0" 
                            placeholder="S/."
                            class="form-control input_cliente" required>
                            <div class="invalid-feedback">
                                Ingrese un precio valido
                            </div>
                        </div>

                        <!-- Stock -->
                        <div class="form-group">
                            <label for="stock">Stock</label>
                            <input type="number" id="stock" name="stock" min="0" class="form-control input_cliente" required>
                            <div class="invalid-feedback">
                                El stock no es valido
                            </div>
                        </div>

                        <!-- Stock min -->
                        <div class="form-group">
                            <label for="stock_min">Stock minimo</label>
                            <input type="number" id="stock_min" name="stock_min" min="0" 
                            class="form-control input_cliente" required>
                            <div class="invalid-feedback">
                                El stock no es valido
                            </div>
                        </div>

                        <!-- Imagen -->
                        <div class="form-group">
                            <label for="telefono">Foto del Item</label>
                            <input type="file" id="foto" name="foto" class="form-control input_cliente">
                            <div class="invalid-feedback">
                                Teléfono es requerido. Ingrese un telefono valido
                            </div>
                        </div>


                        <!-- Descripción -->
                        <div class="form-group">
                            <label for="descripcion">Descripción del Item</label>
                            <textarea id="descripcion" name="descripcion" rows="4" cols="50"></textarea>
                        </div>

                        <button>Registrar Item</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once 'views/layout/footer.php'; ?>

<!-- JS Libraies -->
<script src="<?= URL ?>/public/bundles/datatables/datatables.min.js"></script>
<script src="<?= URL ?>/public/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>

<!-- Page Specific JS File -->
<script src="<?= URL ?>/public/js/cliente.js" type="module"></script>

<?php require_once 'views/layout/foot.php'; ?>