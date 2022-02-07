<?php
    
    require_once ('../includes/app.php'); 
    use Model\Rubro;

    /*$idRol = $_POST['marca'];
    $nombresUsuario = $_POST['nombresUsuario'];
    $apellidosUsuario = $_POST['apellidosUsuario'];
    $usuario = $_POST['usuario'];
    $passwordHash = password_hash( $_POST['password'], PASSWORD_BCRYPT ) ;  //Se hashea la password ingresada al formulario de name= crear-usuario-form
    $emailUsuario = $_POST['email'];
    $observacionesUsuario = $_POST['observacionesUsuario'];*/

    //debuguear($_POST);
    

/*  Este código NO contiene codigo HTML
    Contiene codigo a ejecutarse cuando se hace CLICK en:
                                                            Crear Rubro
                                                            Actualizar Rubro
                                                            Eliminar Rubro
    Por lo que se debe leer el valor de $_POST['button-action-rubro'] */

//$errores = Usuario::getErrores();

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/* Se evalúa si el boton presionado fue Crear Usuario (del archivo crear-usuario.php)*/
if( $_POST['button-action-rubro'] == 'crear' ) {//en caso que exista la variable, se lleerán los valores ingresados
    //try{
        //require_once ('../includes/app.php'); 
        //echo "Se ingresó al IF-crear<br>";
        $rubro = new Rubro($_POST);
        //echo "<pre>";
        //echo "En action-rubro<br>";
        //var_dump($_POST);
        //debuguear($rubro);
        //var_dump($rubro->idRubroPadre);
        //echo "ANTES DE GUARDAR<br>";
        echo $rubro->guardar();

        
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
//echo "NO HACE NADAA!!";

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/* Se evalúa si el boton presionado fue Actualizar Rubro */

if( $_POST['button-action-rubro'] == 'actualizar' ) {//en caso que exista la variable, se lleerán los valores ingresados
    
    /*try{*/
        $id_registro = $_POST['id-registro'];   //la variable $_POST['id-registro'] sólo existe si se ingresa a este IF-ACTUALIZAR

        $rubro = Rubro::find($id_registro);
        // echo "<pre>";
        // var_dump($rubro);
        // echo "</pre>";
        // echo "ya se mostro el rubro como objeto recien creado";
/*      El arreglo $args[] contendra los datos del formulario form_actualizar-producto
    para luego copiar estos valores en el objeto $producto=Producto::find($id)
        El video 364 muestra como resumir todas estas asignaciones
        El video 366 muestra como eliminar la imagen si se la actualiza  */
        $args= [];

        $args['idRubro']= intval($id_registro);;
        $args['nombreRubro']= $_POST['nombreRubro'] ?? null;
        $args['descripcionRubro']= $_POST['descripcionRubro'] ?? null;
        
        if( isset($_POST['ordenRubro']) ) {$args['ordenRubro'] = intval($_POST['ordenRubro']);}
        else {$args['ordenRubro'] = 0;}

        $args['destacadoRubro']= $_POST['destacadoRubro'] ?? null;
        $args['menuRubro']= $_POST['menuRubro'] ?? null;
        $args['estadoRubro']= $_POST['estadoRubro'] ?? null;
        


        $rubro->sincronizar($args);
        //echo "antes del debuguear...<br>";
        //debuguear($rubro);

        //  echo "<pre>";
        //  var_dump($rubro);
        //  echo "</pre>";
        //  echo "ya se mostro el rubro como objeto SINCRONIZADO";



        echo $rubro->actualizar();
        //echo $producto->actualizar();

        /*$stmt = $db->prepare("UPDATE Productos SET nombreProducto = ?, descripcion = ?, precio = ?, color = ?, peso = ?) WHERE idProducto = ? ");
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
    }*/

}//if - ACTUALIZAR

if( $_POST['button-action-rubro'] == 'eliminar' ) {//en caso que exista la variable, se lleerán los valores ingresados
    //try{
        //require_once ('../includes/app.php'); 
        //echo "Se ingresó al IF-crear<br>";
        //$rubro = new Rubro($_POST);
        //echo "<pre>";
        //echo "En action-rubro<br>";
        //var_dump($_POST);
        //debuguear($rubro);
        //var_dump($rubro->idRubroPadre);
        //echo "ANTES DE GUARDAR<br>";
        //echo $rubro->guardar();

//////////////////////////////////////////////////////////////////////////////////////
        /* Eliminacion del Rubro seleccionado */                                    //
                                                                                    //
    /*  VALIDAR $_POST['id-registro'] que contiene el idRubro del rubro a elinminar //
    Al ingresar a esta pagina, se evalua el POST que se recibe,                     //
    si el valor NO es entero, se redirecciona a /admin/lista-rubros.php*/           //
    if( isset($_POST['id-registro']) ) {                                            //
        $id= filter_var($_POST['id-registro'], FILTER_VALIDATE_INT);                  //
        if($id) {                                                                     //
          $rubro= Rubro::find($id);                                                   //
          //echo "Se elimina registro";
          //echo false;
          echo $rubro->eliminar();                                                         //
        }                                                                             //
      }                                                                               //
  //////////////////////////////////////////////////////////////////////////////////////





        
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

} ////if - ELIMINAR











    //include_once 'templates/footer.php';


/*
OBSERVACIONES:
    Cuando se hayan recibido los datos del formulario, en el try se abrirá la conexion a la base de datos
*/
?>