<?php
function conectarDB() : mysqli {//se dice que va a retornar una conexion de mysqli
    //$db= mysqli_connect('localhost', 'root', '1234', 'dipolodb');// para conectar con la base de datos se puede usar PDO en lugar de mysqli
    $db= new mysqli('localhost', 'root', '1234', 'dipolodb');//la linea anterior se reemplaza por esta
    if(!$db) {
        echo  "NO se conecto >=(";
        exit;//esto se hace para NO revelar informacion sensible. Si NO se pudo ejecutar, se detiene la ejecucion del codigo
    }
    return $db;//se retorna una instancia de la conexión
}

?>