<?php

      include_once 'funciones/sesiones.php';/*contiene las funciones que controlan:
                                                      si el usuario esta logueado
                                                      si tiene permitido visitar la pagina/archivo actual*/

    include_once 'funciones/funciones.php';
    /*Al querer EDITAR un producto, se direcciona a este archivo
    junto con un valor de id correspondiente al idProducto a editar.
    Por eso se debe validar el valor de $_GET['id'] que sea un entero*/
    $id = $_GET['id'];
    if( !filter_var($id, FILTER_VALIDATE_INT) ) {
        die ("ERROR!"); //se muestra el mensaje ERROR! si se ingresa un id que NO sea un entero
    }/* este segmento de codigo se situa aqui para NO mostrar contenido HTML si el if es FALSE */
    
    /* CÓDIGO HTML */
    include_once 'templates/header.php';
    include_once 'templates/barra.php';
    include_once 'templates/navegacion.php';

?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Crear Producto
        <small>Llena el formulario para crear un producto</small>
      </h1>
    </section>

    <div class="row">
      <div class="col-md-8">
        <!-- Main content -->
        <section class="content">
          <!-- Default box -->
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Formulario para la Creación de un Producto</h3>
            </div>
            <div class="box-body">

                <?php
                //CONSULTA SQL para obtener el Producto que se quiere actualizar
                    $sql = "SELECT * FROM Productos WHERE idProducto = $id ";
                    $resultado = $db->query($sql);
                    $producto = $resultado->fetch_assoc();
                ?>

              <!-- form start -->
              <form role="form" name="crear-producto" id="crear-producto" method="post" action="action-producto.php">
                <div class="box-body">
                    <div class="form-group">
                          <label for="nombreProducto">Nombre</label>
                          <input type="text" class="form-control" id="nombreProducto" name="nombreProducto" placeholder="Ingresar Nombre del Producto" 
                          value="<?php echo $producto['nombreProducto'];?>" >
                    </div>
                    <div class="form-group">
                          <label for="descripcionProducto">Descripción</label>
                          <input type="text" class="form-control" id="descripcionProducto" name="descripcionProducto"placeholder="Ingresar Descripción" 
                          value="<?php echo $producto['descripcion'];?>" >
                    </div>
                    <div class="form-group">
                          <label for="precioProducto">Precio</label>
                          <input type="text" class="form-control" id="precioProducto" name="precioProducto" placeholder="Ingresar Precio del Producto" 
                          value="<?php echo $producto['precio'];?>" >
                    </div>
                    <div class="form-group">
                          <label for="imagenProducto">Imagen del Producto</label>
                          <input type="file" id="imagenProducto">

                          <p class="help-block">Example block-level help text here.</p>
                    </div>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Actualizar Producto</button>
                    <input type="hidden" name="button-action-producto" value="actualizar"><!-- $_POST['crear-producto] indicara en el archivo de action si éste fue presionado-->
                    <input type="hidden" name="id-registro" value="<?php echo $id; ?>">
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

