<?php


use Model\Rubro;

    include_once 'funciones/sesiones.php';/*contiene las funciones que controlan:
                                                si el usuario esta logueado
                                                si tiene permitido visitar la pagina/archivo actual*/

    include_once '../includes/app.php';

//////////////////////////////////////////////////////////////////////////////////////
/*  VALIDAR $_GET['id'] en URL                                                      //
    Al ingresar a esta pagina, se evalua el GET que se recibe,                      //
    si el valor NO es entero, se redirecciona a /admin/lista-productos.php*/        //
    $id= filter_var($_GET['id'], FILTER_VALIDATE_INT);
    if(!$id) {                                                                      //
        header('Location:  /admin/lista-rubros.php');                               //
    }                                                                               //
//////////////////////////////////////////////////////////////////////////////////////
      
      //include_once 'funciones/funciones.php';
      
      include_once 'templates/header.php';
      include_once 'templates/barra.php';
      include_once 'templates/navegacion.php';
      
    $rubroPadre= Rubro::find($id);

?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                  <h1>
                  Crear Sub-rubro
                  <small>Llena el formulario para crear un sub-rubro</small>
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
                                          <form role="form" name="form_crear-rubro" id="form_crear-rubro" method="post" action="action-rubro.php"> <!--  enctype="multipart/form-data" -->
                                                <div class="box-body"><!-- contenedor de ambas columnas del formulario -->
                                                      <div class="col-md-6 box-body"><!-- 1ra columna del formulario -->
                                                            <div class="form-group" id="div_idRubroPadre">
                                                                  <label for="idRubroPadre" >Rubro padre</label>
                                                                  <input      type="text" class="form-control" 
                                                                              value="<?php echo $rubroPadre->nombreRubro ;?>" disabled>
                                                                  <input      type="hidden" id="idRubroPadre" name="idRubroPadre" 
                                                                              value="<?php echo $rubroPadre->idRubro; ?>">
                                                            </div>
                                                            <div class="form-group">
                                                                  <label for="nombreRubro">Nombre <<< </label>
                                                                  <input type="text" class="form-control" id="nombreRubro" name="nombreRubro" placeholder="Ingresar Nombre del Rubro">
                                                            </div>
                                                            <div class="form-group">
                                                                  <label for="descripcionRubro">Descripcion</label>
                                                                  <input type="text" class="form-control" id="descripcionRubro" name="descripcionRubro" placeholder="Ingresar una descripcion">
                                                            </div>
                                                            <div class="form-group">
                                                                  <label for="ordenRubro">Orden <<< </label>
                                                                  <input type="text" class="form-control" id="ordenRubro" name="ordenRubro"placeholder="Ingresar orden del rubro">
                                                            </div>
                                                            <div class="form-group" id="div_destacadoRubro">
                                                                  <label for="destacadoRubro" >Es destacado <<< <span id="mensaje-error_destacadoRubro" ></span></label>
                                                                  <select class="form-control" name="destacadoRubro" id="destacadoRubro" >
                                                                        <option value="S">Si</option>
                                                                        <option value="N" selected >No</option>
                                                                  </select>
                                                            </div>
                                                            <div class="form-group" id="div_menuRubro">
                                                                  <label for="menuRubro" >Pertenece a la barra de Menu <<< <span id="mensaje-error_menuRubro" ></span></label>
                                                                  <select class="form-control" name="menuRubro" id="menuRubro" >
                                                                        <option value="S">Si</option>
                                                                        <option value="N" selected >No</option>
                                                                  </select>
                                                            </div>
                                                            <div class="form-group" id="div_estadoRubro">
                                                                  <label for="estadoRubro" >Estado <<< <span id="mensaje-error_estadoRubro" ></span></label>
                                                                  <select class="form-control" name="estadoRubro" id="estadoRubro" >
                                                                        <option value="Activo" selected >Activo</option>
                                                                        <option value="Inactivo">Inactivo</option>
                                                                  </select>
                                                            </div>
                                                      </div><!-- FIN 1ra columna del formulario -->
                                                      
                                                </div><!-- contenedor de ambas columnas del formulario -->
                                                
                                                <div class="box-footer">
                                                      <button type="submit" class="btn btn-primary">Crear Subrubro</button>
                                                      <input type="hidden" name="button-action-rubro" value="crear"><!-- $_POST['crear-producto] indicara en el archivo de action si éste fue presionado-->
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

