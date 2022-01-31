<?php 

require 'funciones.php';
require 'config/database.php';
require __DIR__ . '/../vendor/autoload.php';


//Conexion a la BD ////////////////////////////////////////////////////////////////////////////////////////////
$db = conectarDB(); //funcion definida en database.php
                    //devuelve un objeto = conexion a una base de datos especifica

use Model\ActiveRecord; //se accede a las clases definidas en la carpeta ./models

ActiveRecord::setDB($db);   //a la super-clase ActiveRecord se le inicializa su atributo protected statid $db
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
//$activerecord = new ActiveRecord;
//var_dump($activerecord);

?>