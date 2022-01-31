<?php
// -------------  DEFINICIÓN DE FUNCIONES  -------------
function usuario_autenticado() {
    if( !revisar_usuario() ) {// si el usuario NO inició sesión, se redirige a login.php
        header('Location: login.php');
        exit;
    }
}

function revisar_usuario() {
    return isset( $_SESSION['usuario'] );
}
////////////////////////////////////////////////////////


// -------------  EJECUCIÓN  -------------  //
//Se inicia una sesión
session_start();
//Se controla que el usuario esté logueado
usuario_autenticado();


?>