<?php

use Model\Producto;

include_once 'funciones/sesiones.php';/*contiene las funciones que controlan:
                                                si el usuario esta logueado
                                                si tiene permitido visitar la pagina/archivo actual*/

    include_once '../includes/app.php';

//////////////////////////////////////////////////////////////////////////////////////
/*  VALIDAR $_GET['id'] en URL                                                      //
    Al ingresar a esta pagina, se evalua el GET que se recibe,                      //
    si el valor NO es entero, se redirecciona a /admin/lista-productos.php*/        //
    $id= filter_var($_GET['id'], FILTER_VALIDATE_INT);                              //
    if(!$id) {                                                                      //
        header('Location:  /admin/lista-productos.php');                            //
    }                                                                               //
//////////////////////////////////////////////////////////////////////////////////////

    //include_once 'funciones/funciones.php';
    include_once 'templates/header.php';
    include_once 'templates/barra.php';
    include_once 'templates/navegacion.php';


      $producto= Producto::find($id);

      $idProducto= $producto->idProducto;
      $idModelo= $producto->idModelo;
      $idRubro= $producto->idRubro;
      $idSubrubro= $producto->idSubrubro;
      $idMarca= $producto->idMarca;
      $codigoProducto= $producto->codigoProducto;
      $nombreProducto= $producto->nombreProducto;
      $origen= $producto->origen;
      $descripcionProducto= $producto->descripcionProducto;
      $precioTachadoProducto= $producto->precioTachadoProducto;
      $precioVentaProducto= $producto->precioVentaProducto;
      $precioListaProducto= $producto->precioListaProducto;
      $destacadoProducto= $producto->destacadoProducto;
      $ordenProducto= $producto->ordenProducto;
      $vistasProducto= $producto->vistasProducto;
      $stockProducto= $producto->stockProducto;
      $condicion= $producto->condicion;
      $estadoProducto= $producto->estadoProducto;

?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                  <h1>
                  Actualizar Producto
                  <small>Modifica los datos para actualizar el producto</small>
                  </h1>
            </section>

            <div class="row">
                  <div class="col-md-12">
                        <!-- Main content -->
                        <section class="content">
                              <!-- Default box -->
                              <div class="box box-primary">
                                    <!-- <div class="box-header with-border">
                                    <h3 class="box-title">Formulario para la Creación de un Producto</h3>
                                    </div> -->
                                    <div class="box-body">
                                          <!-- form start -->
                                          <form role="form" name="form_actualizar-producto" id="form_actualizar-producto" method="post" action="action-producto.php"> <!--  enctype="multipart/form-data" -->
                                                <div class="box-body"><!-- contenedor de ambas columnas del formulario -->
                                                      <div class="col-md-6 box-body">
                                                            <div class="form-group" id="div_idMarca">
                                                                  <label for="idMarca" >Marca <<< <span id="mensaje-error_idMarca" ></span></label>
                                                                  <select class="form-control" name="idMarca" id="idMarca" value="<?php echo $idMarca;?>">
                                                                        <option value="" selected disabled>--Seleccionar Marca--</option><!-- opcion creada solo para visualizacion, su seleccion NO es valida -->
                                                                        <option value="1">Logitech</option>
                                                                        <option value="2">Redragon</option>
                                                                        <option value="3">EusoCase</option>
                                                                  </select>
                                                            </div>
                                                            <div class="form-group" id="div_idModelo">
                                                                  <label for="idMarca" >Modelo <<< <span id="mensaje-error_idMarca" ></span></label>
                                                                  <select class="form-control" name="idModelo" id="idModelo" >
                                                                        <option value="" selected disabled>--Seleccionar Modelo--</option><!-- opcion creada solo para visualizacion, su seleccion NO es valida -->
                                                                        <option value="1">modelo 1</option>
                                                                        <option value="2">modelo 2</option>
                                                                        <option value="3">modelo 3</option>
                                                                  </select>
                                                            </div>
                                                            <div class="form-group" id="div_idRubro">
                                                                  <label for="idMarca" >Rubro <<< <span id="mensaje-error_idRubro" ></span></label>
                                                                  <select class="form-control" name="idRubro" id="idRubro" >
                                                                        <option value="" selected disabled>--Seleccionar Rubro--</option><!-- opcion creada solo para visualizacion, su seleccion NO es valida -->
                                                                        <option value="1">Computacion</option>
                                                                        <option value="2">Tablets</option>
                                                                        <option value="3">Celulares</option>
                                                                  </select>
                                                            </div>
                                                            <div class="form-group" id="div_idSubrubro">
                                                                  <label for="idMarca" >Subrubro <<< <span id="mensaje-error_idSubrubro" ></span></label>
                                                                  <select class="form-control" name="idSubrubro" id="idSubrubro" >
                                                                        <option value="" selected disabled>--Seleccionar Subrubro--</option><!-- opcion creada solo para visualizacion, su seleccion NO es valida -->
                                                                        <option value="4">subrubro 4</option>
                                                                        <option value="5">subrubro 5</option>
                                                                        <option value="6">subrubro 6</option>
                                                                  </select>
                                                            </div>
                                                            <div class="form-group">
                                                                  <label for="nombreProducto">Nombre <<< </label>
                                                                  <input type="text" class="form-control" id="nombreProducto" name="nombreProducto" placeholder="Ingresar Nombre del Producto"
                                                                        value="<?php echo $nombreProducto; ?>">
                                                            </div>
                                                            <div class="form-group">
                                                                  <label for="origen">Origen</label>
                                                                  <input type="text" class="form-control" id="origen" name="origen" placeholder="Ingresar origen del producto">
                                                            </div>
                                                            <div class="form-group">
                                                                  <label for="codigoProducto">Codigo</label>
                                                                  <input type="text" class="form-control" id="codigoProducto" name="codigoProducto"placeholder="Ingresar codigo">
                                                            </div>
                                                            <div class="form-group">
                                                                  <label for="condicion">Condicion</label>
                                                                  <input type="text" class="form-control" id="condicion" name="condicion"placeholder="Ingresar condicion">
                                                            </div>
                                                            <div class="form-group">
                                                                  <label for="estadoProducto">Estado <<< </label>
                                                                  <input type="text" class="form-control" id="estadoProducto" name="estadoProducto" placeholder="Ingresar estado del Producto"
                                                                        value="<?php echo $estadoProducto; ?>">
                                                            </div>
                                                            <!-- <div class="form-group">
                                                                  <label for="imagenProducto">Imagen del Producto</label>
                                                                  <input type="file" id="imagenProducto[]" name="imagenProducto[]" multiple accept="image/*">

                                                                  <p class="help-block">Example block-level help text here.</p>
                                                            </div> -->
                                                      </div><!-- 1ra columna del formulario -->
                                                      <div class="col-md-6 box-body">
                                                            <div class="form-group">
                                                                  <label for="descripcionProducto">Descripción</label>
                                                                  <input type="text" class="form-control" id="descripcionProducto" name="descripcionProducto"placeholder="Ingresar Descripción"
                                                                        value="<?php echo $descripcionProducto; ?>">
                                                            </div>
                                                            <div class="form-group">
                                                                  <label for="precioTachadoProducto">Precio Tachado</label>
                                                                  <input type="text" class="form-control" id="precioTachadoProducto" name="precioTachadoProducto" placeholder="Ingresar precio tachado del Producto">
                                                            </div>
                                                            <div class="form-group">
                                                                  <label for="precioListaProducto">Precio de Lista</label>
                                                                  <input type="text" class="form-control" id="precioListaProducto" name="precioListaProducto" placeholder="Ingresar precio de lista del Producto">
                                                            </div>
                                                            <div class="form-group">
                                                                  <label for="rubroProducto">Precio de Venta</label>
                                                                  <input type="text"  class="form-control" id="precioVentaProducto" name="precioVentaProducto" placeholder="Ingresar precio de venta del Producto">
                                                            </div>
                                                            <div class="form-group">
                                                                  <label for="destacadoProducto">Es destacado <<< </label>
                                                                  <input type="text" class="form-control" id="destacadoProducto" name="destacadoProducto" placeholder="Ingresar Nombre del Producto"
                                                                        value="<?php echo $destacadoProducto; ?>">
                                                            </div>
                                                            <div class="form-group">
                                                                  <label for="ordenProducto">Orden</label>
                                                                  <input type="text" class="form-control" id="ordenProducto" name="ordenProducto"placeholder="Ingresar Descripción">
                                                            </div>
                                                            <div class="form-group">
                                                                  <label for="vistasProducto">Vistas</label>
                                                                  <input type="text" class="form-control" id="vistasProducto" name="vistasProducto" placeholder="Ingresar vistas del Producto">
                                                            </div>
                                                            <div class="form-group">
                                                                  <label for="stockProducto">Stock <<< </label>
                                                                  <input type="text" class="form-control" id="stockProducto" name="stockProducto" placeholder="Ingresar stock del Producto"
                                                                        value="<?php echo $stockProducto; ?>">
                                                            </div>
                                                      </div><!-- 2da columna del formulario -->
                                                </div><!-- contenedor de ambas columnas del formulario -->
                                                
                                                <div class="box-footer">
                                                      <button type="submit" class="btn btn-primary">Actualizar Producto</button>
                                                      <input type="hidden" name="button-action-producto" value="actualizar"><!-- $_POST['crear-producto] indicara en el archivo de action si éste fue presionado-->
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

