<?php

      include_once 'funciones/sesiones.php';/*contiene las funciones que controlan:
                                                      si el usuario esta logueado
                                                      si tiene permitido visitar la pagina/archivo actual*/

      include_once 'funciones/funciones.php';
      include_once 'templates/header.php';
      include_once 'templates/barra.php';
      include_once 'templates/navegacion.php';
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Crear Rol
        <small>Llena el formulario para crear un rol</small>
      </h1>
    </section>

    <div class="row">
      <div class="col-md-8">
        <!-- Main content -->
        <section class="content">
          <!-- Default box -->
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Formulario para la Creación de un Rol</h3>
            </div>
            <div class="box-body">
              <!-- form start -->
              <form role="form" name="form_crear-rol" id="form_crear-rol" method="post" action="action-rol.php">
                <div class="box-body">
                    <div class="form-group">
                          <label for="nombreRol">Nombre</label>
                          <input type="text" class="form-control" id="nombreRol" name="nombreRol" placeholder="Ingresar nombre del rol">
                    </div>

                    <div class="form-group">
                          <label for="estadoRol">Estado</label>
                          <select class="form-control" name="estadoRol" id="estadoRol">
                            <option value="Activo" selected>Activo</option>
                            <option value="Inactivo" >Inactivo</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                          <label for="observacionesRol">Observaciones</label>
                          <input type="text" class="form-control" id="observacionesRol" name="observacionesRol"placeholder="Ingresar observaciones">
                    </div>
                    
                    <!-- <div class="form-group">
                          <label for="imagenProducto">Imagen del Producto</label>
                          <input type="file" id="imagenProducto">

                          <p class="help-block">Example block-level help text here.</p>
                    </div> -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" class="btn btn-success">Crear Rol</button>
                    <input type="hidden" name="button-action-rol" value="crear"><!-- $_POST['crear-producto] indicara en el archivo de action si éste fue presionado-->
                </div>
              </form>
            </div>
            <!-- /.box-body -->

          </div>
          <!-- /.box -->

        </section>
        <!-- /.content -->
      </div><!-- /.col-md-8 -->
    </div><!-- /.row -->

  </div>
  <!-- /.content-wrapper -->

<?php
      include_once 'templates/footer.php';
?>

