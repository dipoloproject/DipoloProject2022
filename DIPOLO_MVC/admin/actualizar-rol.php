<?php

      include_once 'funciones/sesiones.php';/*contiene las funciones que controlan:
                                                      si el usuario esta logueado
                                                      si tiene permitido visitar la pagina/archivo actual*/

      //include_once 'funciones/funciones.php';
      
      require_once ('../includes/app.php'); 

//////////////////////////////////////////////////////////////////////////////////////
/*  VALIDAR $_GET['id'] en URL                                                      //
    Al ingresar a esta pagina, se evalua el GET que se recibe,                      //
    si el valor NO es entero, se redirecciona a /admin/lista-productos.php*/        //
    $id= filter_var($_GET['id'], FILTER_VALIDATE_INT);  
    //debuguear($id);                            //
    if(!$id) {                                                                      //
        header('Location:  /admin/lista-roles.php');                               //
    }   
                                                                             //
//////////////////////////////////////////////////////////////////////////////////////

      include_once 'templates/header.php';
      include_once 'templates/barra.php';
      include_once 'templates/navegacion.php';


      use Model\Rol;

      $rol= Rol::find($id);
      //echo "<pre>";
      //var_dump($rubro);
      //echo "</pre>";

      $nombreRol= $rol->nombreRol;
      $estadoRol= $rol->estadoRol;
      $observacionesRol= $rol->observacionesRol;

?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                  <h1>
                  Editar Rol
                  <small>Edita el formulario para luego actualizar el rol</small>
                  </h1>
            </section>

            <div class="row">
                  <div class="col-md-12">
                        <!-- Main content -->
                        <section class="content">
                              <!-- Default box -->
                              <div class="box box-danger">
                                    <!-- <div class="box-header with-border">
                                    <h3 class="box-title">Formulario para la Creación de un Producto</h3>
                                    </div> -->
                                    <div class="box-body">       
                                          <!-- form start -->
                                          <form role="form" name="form_actualizar-rol" id="form_actualizar-rol" method="post" action="action-rol.php"> <!--  enctype="multipart/form-data" -->
                                                <div class="box-body"><!-- contenedor de ambas columnas del formulario -->
                                                      <div class="col-md-6 box-body"><!-- 1ra columna del formulario -->
                                                            <!-- <div class="form-group" id="div_idRubroPadre">
                                                                  <label for="idRubroPadre" >Rubro Padre</label><small> (El rubro a crear será hijo del rubro padre)</small>
                                                                  <select class="form-control" name="idRubroPadre" id="idRubroPadre" >
                                                                  <option value="" selected disabled>--Seleccionar Rubro Padre--</option>opcion creada solo para visualizacion, su seleccion NO es valida -->
                                                                        <!-- <?php //foreach($rubros as $rubro) {?>
                                                                              <option value="<?php //echo $rubro->idRubro;?>"> <?php //echo $rubro->nombreRubro; ?> </option>
                                                                        <?php //}?> -->
                                                                        <!-- <?php //buildTreeView_rubros($array, 0); ?> -->
                                                                  <!-- </select> -->
                                                            <!-- </div> -->
                                                            <div class="form-group">
                                                                  <label for="nombreRol">Nombre</label>
                                                                  <input type="text" class="form-control" id="nombreRol" name="nombreRol" placeholder="Ingresar Nombre del Rol" 
                                                                        value="<?php echo $nombreRol;?>">
                                                            </div>

                                                            <div class="form-group" id="div_estadoRol">
                                                                  <label for="estadoRol" >Estado<span id="mensaje-error_estadoRol" ></span></label>
                                                                  <select class="form-control" name="estadoRol" id="estadoRol" >
                                                                        <!-- Se introduce codigo php dentro de <option> para que quede seleccionada la opcion que corresponde -->
                                                                        <option value="Activo" <?php if($estadoRol == 'Activo'){ echo 'selected';}?> >Activo</option>
                                                                        <option value="Inactivo" <?php if($estadoRol == 'Inactivo'){ echo 'selected';}?> >Inactivo</option>
                                                                  </select>
                                                            </div>

                                                            <div class="form-group">
                                                                  <label for="observacionesRol">Oservaciones</label>
                                                                  <input type="text" class="form-control" id="observacionesRol" name="observacionesRol" placeholder="Ingresar una observacion"
                                                                        value="<?php echo $observacionesRol;?>">
                                                            </div>

                                                      </div><!-- FIN 1ra columna del formulario -->
                                                      
                                                </div><!-- contenedor de ambas columnas del formulario -->
                                                
                                                <div class="box-footer">
                                                      <button type="submit" class="btn btn-primary">Actualizar Rol</button>
                                                      <input type="hidden" name="button-action-rol" value="actualizar"><!-- $_POST['crear-producto] indicara en el archivo de action si éste fue presionado-->
                                                      <input type="hidden" name="id-registro" value="<?php echo $id; ?>">
                                                </div>
                                          </form>
                                    </div> <!-- /.box-body -->

                              </div> <!-- /.box box-primary -->

                        </section> <!-- /.content -->
                  </div><!-- /.col-md-12 -->

            </div><!-- /.row -->

      </div>
      <!-- /.content-wrapper -->

<?php
      include_once 'templates/footer.php';
?>

