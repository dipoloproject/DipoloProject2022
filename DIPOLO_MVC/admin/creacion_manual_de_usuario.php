<?php
/* ESTE ARCHIVO DEBE SER ELIMINADO luego de ejecutarse!! */

/* Antes de ejecutar este archivo, se debe crear el Rol de Super-usuario */
    include_once '../includes/app.php';

$nombres = "Pablo";
$apellidos = "Salado";
$usuario= "PabloSalado2022";
$password= "123456";
$emailUsuario = "pablosalado@gmail.com";

$passwordHash= password_hash( $password, PASSWORD_BCRYPT);

$query = "  INSERT INTO Usuarios (idRol, nombres, apellidos, usuario, password, emailUsuario) 
            VALUES ( 1, '${nombres}','${apellidos}', '${usuario}', '${passwordHash}', '${emailUsuario}');";

if( $db->query($query) ) //la inserción se realiza con ÉXITO
    {
        echo("SE INSERTÓ EL USUARIO MANUALMENTE CON ÉXITO!!");
    } else {
        echo("NO se logró crear al usuario manualmente");
    }


/* Este archivo luego de ser ejecutado ya puede ser ELIMINADO */
?>