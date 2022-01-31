<?php

      include_once 'funciones/sesiones.php';/*contiene las funciones que controlan:
                                                      si el usuario esta logueado
                                                      si tiene permitido visitar la pagina/archivo actual*/

      //include_once 'funciones/funciones.php';
      include_once '../includes/app.php';

      include_once 'templates/header.php';
      include_once 'templates/barra.php';
      include_once 'templates/navegacion.php';
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Crear Usuario
        <small>Llena el formulario para crear un usuario</small>
      </h1>
    </section>

    <div class="row">
      <div class="col-md-8">
        <!-- Main content -->
        <section class="content">
          <!-- Default box -->
          <div class="box">
            <!-- <div class="box-header with-border"> -->
              <!-- <h3 class="box-title">Formulario para la Creación de un Usuario</h3> -->
            <!-- </div> -->
            <div class="box-body">
              <!-- form start -->
              <form role="form" name="form_crear-usuario" id="form_crear-usuario" method="post" action="action-usuario.php">
                <div class="box-body">
                    <div class="form-group" id="div_idRol">
                          <label for="idRol" >Rol <span id="mensaje-error_idRol" ></span></label>
                          <select class="form-control" name="idRol" id="idRol" >
                              <option value="" selected disabled>--Seleccionar rol--</option><!-- opcion creada solo para visualizacion, su seleccion NO es valida -->
                              <option value="2">Encargado</option>
                              <option value="3">Vendedor</option>
                              <option value="4">Catalogador</option>
                          </select>
                    </div>

                    <div class="form-group" id="div_nombresUsuario">
                          <label for="nombresUsuario">Nombre/s <span id="mensaje-error_nombresUsuario" ></span></label> 
                          <input type="text" class="form-control" id="nombresUsuario" name="nombresUsuario" placeholder="Ingresar nombre/s del usuario">
                    </div>
                    <div class="form-group" id="div_apellidosUsuario"> 
                          <label for="apellidosUsuario">Apellido/s <span id="mensaje-error_apellidosUsuario"></span></label>
                          <input type="text" class="form-control" id="apellidosUsuario" name="apellidosUsuario" placeholder="Ingresar apellido/s del usuario">
                    </div>
                    <div class="form-group" id="div_usuario"> <!-- <div id="mensaje-error_usuario" ></div> -->
                          <label for="usuario">Usuario <span id="mensaje-error_usuario"></span></label> 
                          <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Ingresar usuario">
                    </div>
                    <div class="form-group" id="div_password">
                          <label for="password">Password <span id="mensaje-error_password"></span></label>
                          <input type="text" class="form-control" id="password" name="password" placeholder="Ingresar password">
                    </div>

                    <!-- GENERAR TOKEN -->

                    <div class="form-group" id="div_email">
                          <label for="email">E-mail <span id="mensaje-error_email"></span></label>
                          <input type="email" class="form-control" id="email" name="email" placeholder="Ingresar e-mail">
                    </div>
                    
                    <div class="form-group">
                          <label for="observacionesUsuario">Observaciones</label>
                          <small>(opcional)</small>
                          <input type="text" class="form-control" id="observacionesUsuario" name="observacionesUsuario"placeholder="Ingresar observaciones">
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" class="btn btn-success">Crear Usuario</button>
                    <input type="hidden" name="button-action-usuario" value="crear"><!-- $_POST['crear-producto] indicara en el archivo de action si éste fue presionado-->
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

