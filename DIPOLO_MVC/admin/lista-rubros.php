<?php

        include_once 'funciones/sesiones.php';/*contiene las funciones que controlan:
                                                      si el usuario esta logueado
                                                      si tiene permitido visitar la pagina/archivo actual*/

    //include_once 'funciones/funciones.php';
    require_once ('../includes/app.php'); 
    use Model\Rubro;


//////////////////////////////////////////////////////////////////////////////////////
        /* Eliminacion del Rubro seleccionado */                                    //
                                                                                    //
    /*  VALIDAR $_POST['id-registro'] que contiene el idRubro del rubro a elinminar //
    Al ingresar a esta pagina, se evalua el POST que se recibe,                     //
    si el valor NO es entero, se redirecciona a /admin/lista-rubros.php*/           //
    if( isset($_POST['id-registro']) ) {                                            //
      $id= filter_var($_POST['id-registro'], FILTER_VALIDATE_INT);                  //
      if($id) {                                                                     //
        //$rubro= Rubro::find($id);                                                   //
        //$rubro->eliminar();                                                         //
      }                                                                             //
    }                                                                               //
//////////////////////////////////////////////////////////////////////////////////////

        include_once 'templates/header.php';
        include_once 'templates/barra.php';
        include_once 'templates/navegacion.php';
        


?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Listado de Rubros
        <!-- <small></small> -->
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-danger">
            <div> <!-- class="box-header"-->
              <!-- <h3 class="box-title">Sección de administración de Productos</h3> -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="registros" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Nombre</th>
                  <!-- <th>Precio</th> -->
                  <!-- <th>Descripción</th> -->
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
                        $rubros = Rubro::allTopLevel(); //la variable guarda un arreglo de objetos (registros o filas del resultSet)
                        //debuguear($productos);
                        foreach( $rubros as $rubro ): ?>
                        <?php if($rubro->idRubroPadre == null ) {?>
                            <tr>
                                <td> <?php echo $rubro->nombreRubro; ?> </td>
                                <!-- <td>$&nbsp<?php echo $producto->precioVentaProducto; ?> </td> -->
                                <!-- <td> <?php echo $producto->descripcionProducto; ?> </td> -->
                                
                                <!-- Botones de ACCIONES: Crear/Editar/Eliminar -->
                                <!-- La accion Eliminar será un formulario, las demas seran enlaces -->
                                <td style="display: inline-block;" class="box-create-info-edit-delete">
                                    <a  href="crear-subrubro.php?id=<?php echo $rubro->idRubro; ?>" 
                                        class="btn btn-xs bg-green btn-flat margin"
                                        title="Crear subrubro">
                                            <i class="fa fa-sitemap" ></i>
                                    </a>
                                    <a  href="lista-subrubros.php?id=<?php echo $rubro->idRubro; ?>" 
                                        class="btn btn-xs bg-orange btn-flat margin"
                                        title="Mostrar subrubros">
                                            <i class="fa fa-info-circle" ></i>
                                    </a>
                                    <a  href="actualizar-rubro.php?id=<?php echo $rubro->idRubro; ?>" 
                                        class="btn btn-xs bg-blue btn-flat margin"
                                        title="Editar">
                                            <i class="fa fa-pencil" ></i>
                                    </a>
                                   
                                    <form role="form" class="form_eliminar-rubro btn btn-xs bg-red btn-flat margin" name="form_eliminar-rubro" method="post" action="action-rubro.php">
                                      <button type="submit" class="btn btn-xs bg-red btn-flat" title="Eliminar" style="padding: 0rem;">
                                        <i class="fa fa-trash" ></i>
                                      </button>
                                      <input type="hidden" name="button-action-rubro" value="eliminar"><!-- $_POST['crear-producto] indicara en el archivo de action si éste fue presionado-->
                                      <input type="hidden" name="id-registro" value="<?php echo $rubro->idRubro; ?>">
                                    </form>
                                </td>
                            </tr>


                        <?php } ?>    
                        <?php endforeach; ?>

                
                </tbody>
                <tfoot>
                <tr>
                    <th>Nombre</th>
                    <!-- <th>Precio</th> -->
                    <!-- <th>Descripción</th> -->
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

