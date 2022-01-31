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
    $id= filter_var($_GET['id'], FILTER_VALIDATE_INT);                              //
    if(!$id) {                                                                      //
        header('Location:  /admin/lista-rubros.php');                               //
    }                                                                               //
//////////////////////////////////////////////////////////////////////////////////////

    //include_once 'funciones/funciones.php';
    
      include_once 'templates/header.php';
      include_once 'templates/barra.php';
      include_once 'templates/navegacion.php';
        
        //require_once ('../includes/app.php'); 


  //Determinar el Nombre del Rubro Padre
  $rubroPadre = Rubro::find($id);
  //debuguear($rubroPadre);



?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h3 style="margin-top: 0rem;">Rubro: <?php echo $rubroPadre->nombreRubro;?></h3>
      <h3 style=" text-align: center; 
                  margin-top: 1rem;
                  margin-bottom: 0rem;">Listado de Sub-rubros
      </h3>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div> <!-- class="box-header"-->
              <!-- <h3 class="box-title" style="padding-left: 1rem;">Rubro Padre: <?php echo $rubroPadre->nombreRubro;?></h3> STYLE -->
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
                        $rubros = Rubro::all(); //la variable guarda un arreglo de objetos (registros o filas del resultSet)
                        //debuguear($productos);
                        foreach( $rubros as $rubro ): ?>
                        <?php if($rubro->idRubroPadre == $id ) {?>
                            <tr>
                                <td> <?php echo $rubro->nombreRubro; ?> </td>
                                <!-- <td>$&nbsp<?php echo $producto->precioVentaProducto; ?> </td> -->
                                <!-- <td> <?php echo $producto->descripcionProducto; ?> </td> -->
                                
                                <!-- Botones de ACCIONES: Editar/Eliminar -->
                                <td class="box-create-info-edit-delete">
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
                                    <a  href="#" data-id="<?php echo $rubro->idRubro; ?>" data-tipo="rubro" 
                                        class="btn btn-xs bg-red btn-flat margin borrar-registro"
                                        title="Eliminar">
                                            <i class="fa fa-trash" ></i>
                                    </a>
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

