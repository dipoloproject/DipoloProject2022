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
    $id= filter_var($_GET['id'], FILTER_VALIDATE_INT);                              //
    if(!$id) {                                                                      //
        header('Location:  /admin/lista-rubros.php');                               //
    }                                                                               //
//////////////////////////////////////////////////////////////////////////////////////

      include_once 'templates/header.php';
      include_once 'templates/barra.php';
      include_once 'templates/navegacion.php';


      use Model\Rubro;

      $array=[];
      //$rubros= Rubro::all();
      //debuguear($rubros);

      $array= Rubro::arrayTree();  /*devuelve un array de elementos donde cada elemento
                                    /*es un elemento asociativo que contiene como llaves:
                                    nombreRubro y idRubroPadre con sus respectivos valores*/
      //debuguear($array);
      //buildTreeView($array, 0);     //funcion que acomoda visualmente los rubros padres y los rubros hijos
                                    //se encuentra definida en includes/funciones.php
      
      
      //buildTreeView($array,0);


      $rubro= Rubro::find($id);
      //echo "<pre>";
      //var_dump($rubro);
      //echo "</pre>";

      $nombreRubro= $rubro->nombreRubro;
      $descripcionRubro= $rubro->descripcionRubro;
      $ordenRubro= $rubro->ordenRubro;
      $destacadoRubro= $rubro->destacadoRubro;
      $menuRubro= $rubro->menuRubro;
      $estadoRubro= $rubro->estadoRubro;

?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                  <h1>
                  Editar Rubro
                  <small>Edita el formulario para luego actualizar el rubro</small>
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
                                          <form role="form" name="form_actualizar-rubro" id="form_actualizar-rubro" method="post" action="action-rubro.php"> <!--  enctype="multipart/form-data" -->
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
                                                                  <label for="nombreRubro">Nombre</label>
                                                                  <input type="text" class="form-control" id="nombreRubro" name="nombreRubro" placeholder="Ingresar Nombre del Rubro" 
                                                                        value="<?php echo $nombreRubro;?>">
                                                            </div>
                                                            <div class="form-group">
                                                                  <label for="descripcionRubro">Descripcion</label>
                                                                  <input type="text" class="form-control" id="descripcionRubro" name="descripcionRubro" placeholder="Ingresar una descripcion"
                                                                        value="<?php echo $descripcionRubro;?>">
                                                            </div>
                                                            <div class="form-group">
                                                                  <label for="ordenRubro">Orden</label><small>(Orden en el que éste rubro será mostrado en el menu desplegable)</small>
                                                                  <input type="text" class="form-control" id="ordenRubro" name="ordenRubro"placeholder="Ingresar orden del rubro"
                                                                        value="<?php echo $ordenRubro;?>">
                                                            </div>
                                                            <div class="form-group" id="div_destacadoRubro">
                                                                  <label for="destacadoRubro" >Es destacado<span id="mensaje-error_destacadoRubro" ></span></label>
                                                                  <select class="form-control" name="destacadoRubro" id="destacadoRubro" >
                                                                        <!-- Se introduce codigo php dentro de <option> para que quede seleccionada la opcion que corresponde -->
                                                                        <option value="S" <?php if($destacadoRubro == 'S'){ echo 'selected';}?> >Si</option>
                                                                        <option value="N" <?php if($destacadoRubro == 'N'){ echo 'selected';}?> >No</option>
                                                                  </select>
                                                            </div>
                                                            <div class="form-group" id="div_menuRubro">
                                                                  <label for="menuRubro" >Pertenece a la barra de Menu<span id="mensaje-error_menuRubro" ></span></label>
                                                                  <select class="form-control" name="menuRubro" id="menuRubro" >
                                                                        <!-- Se introduce codigo php dentro de <option> para que quede seleccionada la opcion que corresponde -->
                                                                        <option value="S" <?php if($menuRubro == 'S'){ echo 'selected';}?> >Si</option>
                                                                        <option value="N" <?php if($menuRubro == 'N'){ echo 'selected';}?> >No</option>
                                                                  </select>
                                                            </div>
                                                            <div class="form-group" id="div_estadoRubro">
                                                                  <label for="estadoRubro" >Estado<span id="mensaje-error_estadoRubro" ></span></label>
                                                                  <select class="form-control" name="estadoRubro" id="estadoRubro" >
                                                                        <!-- Se introduce codigo php dentro de <option> para que quede seleccionada la opcion que corresponde -->
                                                                        <option value="Activo" <?php if($estadoRubro == 'Activo'){ echo 'selected';}?> >Activo</option>
                                                                        <option value="Inactivo" <?php if($estadoRubro == 'Inactivo'){ echo 'selected';}?> >Inactivo</option>
                                                                  </select>
                                                            </div>
                                                      </div><!-- FIN 1ra columna del formulario -->
                                                      
                                                </div><!-- contenedor de ambas columnas del formulario -->
                                                
                                                <div class="box-footer">
                                                      <button type="submit" class="btn btn-primary">Actualizar Rubro</button>
                                                      <input type="hidden" name="button-action-rubro" value="actualizar"><!-- $_POST['crear-producto] indicara en el archivo de action si éste fue presionado-->
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

