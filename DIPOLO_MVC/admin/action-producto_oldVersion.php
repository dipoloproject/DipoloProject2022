
<?php
    include_once 'funciones/funciones.php';

    $nombreProducto = $_POST['nombreProducto'];
    $descripcionProducto = $_POST['descripcionProducto'];
    $precioProducto = $_POST['precioProducto'];

    

/*  Este código NO contiene codigo HTML
    Contiene codigo a ejecutarse cuando se hace CLICK en:
                                                            Crear Producto
                                                            Actualizar Producto
                                                            Eliminar Producto
    Por lo que se debe leer el valor de $_POST['button-action-producto'] */


/* Se evalúa si el boton presionado fue Crear Producto */
if( $_POST['button-action-producto'] == 'crear' ) {//en caso que exista la variable, se lleerán los valores ingresados
    //var_dump(true);
    //try{
        $db = conectarDB();
        $stmt = $db->prepare( "INSERT INTO Productos (nombreProducto, descripcion, precio) VALUES (?, ?, ?) ;" );
        $stmt->bind_param("ssd", $nombreProducto, $descripcionProducto, $precioProducto);
        $stmt->execute();
        //$stmt->bind_result($nombreProducto_result, $descripcion_result, $precio_result);
//var_dump($stmt->affected_rows);

//echo "LUEGO DE LA INSERCION Y ANTES DEL IF<br>";
        
        if( isset($stmt->affected_rows) ) {    //devuelve un entero = 1
        //    $existe = $stmt->fetch();
        //    if($existe) {
                //echo "DENTRO DEL IF ANTES DEL TRUE<br>";
            echo true;  //indicará que el inicio de sesión fue EXITOSO
            //exit;
        } else {
                //echo "DENTRO DEL ELSE ANTES DEL FALSE<br>";
            echo false;     //indicara inicio de sesión FALLIDO
        }
        //echo true;
        
        $stmt->close();
        $db->close();
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