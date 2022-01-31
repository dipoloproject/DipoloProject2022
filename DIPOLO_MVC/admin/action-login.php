<?php
/*
<head>
<link rel="shortcut icon" href="#"><!-- esta linea resuelve el error: GET http://localhost:3000/favicon.ico 404 (Not Found) -->
<!--  </head> */

if( isset( $_POST['button-login-admin'] ) ) {//en caso que exista la variable, 
    //try{
        require_once ('../includes/app.php');

        $db = conectarDB();
        
        $usuario = $_POST['usuario'];
        $password = $_POST['password'];

        $stmt = $db->prepare("SELECT * FROM Usuarios WHERE usuario= ?;");
        $stmt->bind_param("s", $usuario);
        $stmt->execute();
        $stmt->bind_result( $idUsuario_result, $idRol_result, $nombres_result, $apellidos_result, 
                            $usuario_result, $password_result, $token_result, $email_result, 
                            $intentosIngresarPassword_result, $fechaUltimoIntentoIngresarPassword_result, 
                            $debeCambiarPassword_result, $estadoUsuario_result, $observacionesUsuario_result);

        if($stmt->affected_rows) {
            $existe = $stmt->fetch();   //guarda la fila obtenida como unico resultado de la consulta
            if($existe) {
                if( password_verify($password, $password_result) ) {

                    //Creacion de sesión + Asignacion de valores a $_SESSION
                    session_start();    //se inicia una sesión
                    $_SESSION['usuario'] = $usuario_result;     /*  esta variable es evaluada en sesiones.php
                                                                    de manera que se sabrá si se inició o no sesion*/
                   /*$_SESSION['rol'] = $idRol_result;   //SE DEBE HACER UNA COMPROBACION DE ROLES EN CADA PAGINA
                                                        O SECCION DEL SITIO WEB */

                    //var_dump($_SESSION['nombre_completo']);
                    //$_SESSION['nombre'] = $nombre_result;
                    //
                    
                    //Respuesta del servidor hacia AJAX
                    echo true;  //indicará que el inicio de sesión fue EXITOSO
                }
            } else {
                echo false;     //indicara inicio de sesión FALLIDO
            }
        }
        /*Se utiliza close() para cerrar conexiones y evitar que se el servidor pierda eficiencia*/
        $stmt->close();
        $db->close();

        //$usuario = $_POST['usuario'];
        
        //$query = "SELECT * FROM Usuarios WHERE email= '${usuario}'";

        //$resultado = $db->query($query);

        
        /*if($resultado->num_rows>0) {
        
            while( $registro = $resultado->fetch_assoc() ) {//$registro guarda cada vector asociativo
                //echo($registro['idUsuario']);
                //echo ("<br>");
            }

            $resultado->free();
            $db->close();
            $_POST['login_admin_respuesta'] = '';
            $_POST['login_admin_respuesta'] = 'exito';

            $resultado = array('respuesta'=>'exito');
            
            echo true;

        } else {
            echo false;
        }*/

    // } catch (Exception $e) {                    //nunca ingresó aqui!!
        //echo "Ingresó al CATCH <br><br>";
        //echo "Error: " . $e->getMessage();
    //}

} else {    //NO existen las variables name de $_POST
    
    //$respuesta = array('respuesta'=>'error');
    
}

//include_once 'templates/header.php';
//include_once 'templates/footer.php';

/*
OBSERVACIONES:
    Cuando se hayan recibido los datos del formulario, en el try se abrirá la conexion a la base de datos
*/

?>