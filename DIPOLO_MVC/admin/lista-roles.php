<?php

        include_once 'funciones/sesiones.php';/*contiene las funciones que controlan:
                                                      si el usuario esta logueado
                                                      si tiene permitido visitar la pagina/archivo actual*/

    //include_once 'funciones/funciones.php';
    require_once ('../includes/app.php'); 
    use Model\Rol;


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
        Listado de Roles
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
                  <th>Estado</th>
                  <th>Observaciones</th>
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
                        $roles = Rol::all(); //la variable guarda un arreglo de objetos (registros o filas del resultSet)
                        //debuguear($productos);
                        foreach( $roles as $rol ): ?>
                        <tr>
                          <td> <?php echo $rol->nombreRol; ?> </td>
                          <td> <?php echo $rol->estadoRol; ?> </td>
                          <td> <?php echo $rol->observacionesRol; ?> </td>
                                <!-- Botones de ACCIONES: Crear/Editar/Eliminar -->
                                <!-- La accion Eliminar será un formulario, las demas seran enlaces -->
                                <td style="display: inline-block;" class="box-create-info-edit-delete">
                                    <a  href="actualizar-rol.php?id=<?php echo $rol->idRol; ?>" 
                                        class="btn btn-xs bg-blue btn-flat margin"
                                        title="Editar">
                                            <i class="fa fa-pencil" ></i>
                                    </a>
                                   
                                    <form role="form" class="form_eliminar-rol btn btn-xs bg-red btn-flat margin" name="form_eliminar-rol" method="post" action="action-rol.php">
                                      <button type="submit" class="btn btn-xs bg-red btn-flat" title="Eliminar" style="padding: 0rem;">
                                        <i class="fa fa-trash" ></i>
                                      </button>
                                      <input type="hidden" name="button-action-rol" value="eliminar"><!-- $_POST['crear-producto] indicara en el archivo de action si éste fue presionado-->
                                      <input type="hidden" name="id-registro" value="<?php echo $rol->idRol; ?>">
                                    </form>
                                </td>
                            </tr>
 
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

