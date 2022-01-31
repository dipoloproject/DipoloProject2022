<?php
    //include_once 'funciones/funciones.php';
    require_once ('../includes/app.php'); 
    //require '../models/ActiveRecord.php';
    //require '../models/usuario.php';
    //namespace Model;
    //use Model\ActiveRecord;
    use Model\Usuario;

        
    $idRol = $_POST['idRol'];
    $nombresUsuario = $_POST['nombresUsuario'];
    $apellidosUsuario = $_POST['apellidosUsuario'];
    $usuario = $_POST['usuario'];
    $passwordHash = password_hash( $_POST['password'], PASSWORD_BCRYPT ) ;  //Se hashea la password ingresada al formulario de name= crear-usuario-form
    $emailUsuario = $_POST['email'];
    $observacionesUsuario = $_POST['observacionesUsuario'];

    //debuguear($_POST);
    

/*  Este código NO contiene codigo HTML
    Contiene codigo a ejecutarse cuando se hace CLICK en:
                                                            Crear Producto
                                                            Actualizar Producto
                                                            Eliminar Producto
    Por lo que se debe leer el valor de $_POST['button-action-producto'] */

$errores = Usuario::getErrores();



/* Se evalúa si el boton presionado fue Crear Usuario (del archivo crear-usuario.php)*/
if( $_POST['button-action-usuario'] == 'crear' ) {//en caso que exista la variable, se lleerán los valores ingresados
    //try{
        //require_once ('../includes/app.php'); 
        $usuario = new Usuario($_POST);
        //echo "ANTES DE GUARDAR<br>";
        echo $usuario->guardar();

        
        //$errores= $usuario->validar();
        // if( empty($errores) ) {
        //     $usuario->guardar();
        // }


        
        
        //$stmt->close();
        //$db->close();
// exit;
    //} catch (Exception $e) {
        //echo "Error: " . $e->getMessage();
    //}

} ////if - CREAR



/* Se evalúa si el boton presionado fue Actualizar Producto */
/*
if( $_POST['button-action-producto'] == 'actualizar' ) {//en caso que exista la variable, se lleerán los valores ingresados
    
    try{

        $id_registro = $_POST['id-registro'];   //la variable $_POST['id-registro'] sólo existe si se ingresa a este IF-ACTUALIZAR

        $stmt = $db->prepare("UPDATE Productos SET nombreProducto = ?, descripcion = ?, precio = ?, color = ?, peso = ?) WHERE idProducto = ? ");
        $stmt->bind_param("ssdsdi", $nombreProducto, $descripcionProducto, $precioProducto, );
        $stmt->execute();
        if( $stmt->affected_rows ) {
            $respuesta = array(
                'respuesta'=>'exito',
                'id_admin'=> $stmt
            );
        } else {
            $respuesta = array(
                'respuesta'=>'error'
            );
        }
        $stmt->close();
        $db->close();
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }

}//if - ACTUALIZAR
*/

    //include_once 'templates/footer.php';


/*
OBSERVACIONES:
    Cuando se hayan recibido los datos del formulario, en el try se abrirá la conexion a la base de datos
*/
?>