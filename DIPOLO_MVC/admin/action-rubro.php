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

        $producto = Rubro::find($id_registro);


/*      El arreglo $args[] contendra los datos del formulario form_actualizar-producto
    para luego copiar estos valores en el objeto $producto=Producto::find($id)
        El video 364 muestra como resumir todas estas asignaciones
        El video 366 muestra como eliminar la imagen si se la actualiza  */
        $args= [];
        $args['idModelo']= $_POST['idModelo'] ?? null;
        $args['idRubro']= $_POST['idRubro'] ?? null;
        // $args['idSubrubro']= $_POST['idSubrubro'] ?? null;
        $args['idMarca']= $_POST['idMarca'] ?? null;
        $args['codigoProducto']= $_POST['codigoProducto'] ?? null;
        $args['nombreProducto']= $_POST['nombreProducto'] ?? null;
        $args['origen']= $_POST['origen'] ?? null;
        $args['descripcionProducto']= $_POST['descripcionProducto'] ?? null;

        //$args['precioTachadoProducto']= $_POST['precioTachadoProducto'] ?? intval(0);
        if( isset($_POST['precioTachadoProducto']) ) {$args['precioTachadoProducto'] = intval($_POST['precioTachadoProducto']);}
        else {$args['precioTachadoProducto'] = 0;}

        //$args['precioVentaProducto']= $_POST['precioVentaProducto'] ?? 0;
        if( isset($_POST['precioVentaProducto']) ) {$args['precioVentaProducto'] = intval($_POST['precioVentaProducto']);}
        else {$args['precioVentaProducto'] = 0;}
        //$args['precioListaProducto']= $_POST['precioListaProducto'] ?? 0;
        if( isset($_POST['precioListaProducto']) ) {$args['precioListaProducto'] = intval($_POST['precioListaProducto']);}
        else {$args['precioListaProducto'] = 0;}
        
        $args['destacadoProducto']= $_POST['destacadoProducto'] ?? null;
        
        //$args['ordenProducto']= $_POST['ordenProducto'] ?? null;
        if( isset($_POST['ordenProducto']) ) {$args['ordenProducto'] = intval($_POST['ordenProducto']);}
        else {$args['ordenProducto'] = 0;}

        //$args['vistasProducto']= $_POST['vistasProducto'] ?? null;
        if( isset($_POST['vistasProducto']) ) {$args['vistasProducto'] = intval($_POST['vistasProducto']);}
        else {$args['vistasProducto'] = 0;}

        $args['stockProducto']= $_POST['stockProducto'] ?? null;
        $args['condicion']= $_POST['condicion'] ?? null;
        $args['estadoProducto']= $_POST['estadoProducto'] ?? null;


        $producto->sincronizar($args);
        echo "antes del debuguear...<br>";
        //debuguear($producto);



        $producto->actualizar();
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


    //include_once 'templates/footer.php';


/*
OBSERVACIONES:
    Cuando se hayan recibido los datos del formulario, en el try se abrirá la conexion a la base de datos
*/
?>