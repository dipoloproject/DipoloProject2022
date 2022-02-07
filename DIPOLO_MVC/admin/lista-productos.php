<?php

        include_once 'funciones/sesiones.php';/*contiene las funciones que controlan:
                                                      si el usuario esta logueado
                                                      si tiene permitido visitar la pagina/archivo actual*/

    //include_once 'funciones/funciones.php';
    
        include_once 'templates/header.php';
        include_once 'templates/barra.php';
        include_once 'templates/navegacion.php';
        
        require_once ('../includes/app.php'); 
        use Model\Producto;
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Listado de Productos
        <!-- <small></small> -->
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-success">
            <div> <!-- class="box-header"-->
              <!-- <h3 class="box-title">Sección de administración de Productos</h3> -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="registros" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Nombre del producto</th>
                  <th>Precio</th>
                  <th>Descripción</th>
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                    <?php
                        /*try {

                          $productos = Producto::all(); //la variable guarda un arreglo de objetos (registros o filas del resultSet)


                            // $sql = "SELECT idCategoria, idProducto, nombreProducto, precio, peso, color, descripcion FROM Productos";
                            // $resultado = $db->query($sql);
                        } catch (Exception $e) {
                            $error = $e->getMessage();
                            echo $error;
                        }*/
                        $productos = Producto::all(); //la variable guarda un arreglo de objetos (registros o filas del resultSet)
                        //debuguear($productos);
                        foreach( $productos as $producto ): ?>

                            <tr>
                                <td> <?php echo $producto->nombreProducto; ?> </td>
                                <td>$&nbsp<?php echo $producto->precioVentaProducto; ?> </td>
                                <td> <?php echo $producto->descripcionProducto; ?> </td>
                                
                                <!-- Botones de ACCIONES: Editar/Eliminar -->
                                <td class="box-edit-delete">
                                    <a  href="actualizar-producto.php?id=<?php echo $producto->idProducto; ?>" 
                                        class="btn btn-xs bg-blue btn-flat margin">
                                            <i class="fa fa-pencil" ></i>
                                    </a>
                                    <a  href="#" data-id="<?php echo $producto->idProducto; ?>" data-tipo="producto" 
                                        class="btn btn-xs bg-red btn-flat margin borrar-registro">
                                            <i class="fa fa-trash" ></i>
                                    </a>
                                </td>
                            </tr>



                        <?php endforeach; ?>

                
                </tbody>
                <tfoot>
                <tr>
                    <th>Nombre del producto</th>
                    <th>Precio</th>
                    <th>Descripción</th>
                    <th>Acciones</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->


  </div>
  <!-- /.content-wrapper -->

<?php
      include_once 'templates/footer.php';
?>

