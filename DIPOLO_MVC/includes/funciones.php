<?php
define('TEMPLATES_URL', __DIR__ . '/templates');
define('FUNCIONES_URL', __DIR__ . 'funciones.php');
//define('CARPETA_IMAGENES', __DIR__ . '/../imagenes/');
define('CARPETA_IMAGENES', $_SERVER['DOCUMENT_ROOT'] . '/imagenes/');
//require 'app.php';//esta linea se elimina



function incluirTemplate(string $nombre) {
    include TEMPLATES_URL . "/${nombre}.php";
}


function estaAutenticado() {
    session_start();
    
    if(!$_SESSION['login']) {
        //return true; en vez de esto se hara:
        header('Location: /');
    }
    //return false;este return tambien se comenta
}

function debuguear($variable) {//muestra variables formateadas
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

//ESCAPA/SANITIZA  el HTML
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}


//VALIDAR tipo de contenido
function validarTipoContenido($tipo) {
    $tipos = ['producto', 'categoria'];
    return in_array($tipo, $tipos);
}


//Muestra los mensajes
function mostrarNotificacion($codigo) {
    $mensaje='';

    switch($codigo) {
        case 1:
            $mensaje = 'Creado Correctamente';
            break;
        case 2:
            $mensaje = 'Actualizado Correctamente';
            break;
        case 3:
            $mensaje = 'Eliminado Correctamente';
            break;
        default:
            $mensaje = false;
            break;
    }
    return $mensaje;
}


function validarORedireccionar(string $url) {

    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);//se valida que sea un entero

    if(!$id) {
        header("Location: ${url}");
    }//si NO existe un id que sea numero, direcciona al index.php
    return $id;
}

///////////////////////////////////////////////////////////////////////////////
//ESTE ES EL CODIGO QUE SE EJECUTA EN EL SELECT DEL ARCHIVO CREAR PRODUCTO.PHP
function buildTreeView_productos($array, $parent, $level=0, $prelevel=-1) {
    foreach( $array as $id=>$data) {
          if( $parent == $data['idRubroPadre']) {
                if( $level > $prelevel) {?>
                      <ul>
                <?php }
                if($level == $prelevel) {?>
                      </li>
                <?php }?>
                <li><option value="<?php echo $id; ?>"
                            <?php if($data['esPadre']=='S') { echo 'disabled';} ?> > 
                                <?php 
                                    if ($data['idRubroPadre']=$level) { ?> &nbsp;&nbsp;&nbsp;<?php }
                                
                                ?>

                                <?php echo $data['nombreRubro']; ?> </option>
                <?php if($level>$prelevel) {
                      $prelevel=$level;
                }
                $level++;
                buildTreeView_productos($array, $id, $level, $prelevel);
                $level--;
          }
          
    }
    if($level == $prelevel) { ?>
          </li></ul>
    <?php }
}

///////////////////////////////////////////////////////////////////////////////
//ESTE ES EL CODIGO QUE SE EJECUTA EN EL SELECT DEL ARCHIVO CREAR RUBROS.PHP
function buildTreeView_rubros($array, $parent, $level=0, $prelevel=-1) {
    foreach( $array as $id=>$data) {
          if( $parent == $data['idRubroPadre']) {
                if( $level > $prelevel) {?>
                      <ul>
                <?php }
                if($level == $prelevel) {?>
                      </li>
                <?php }?>
                <li><option value="<?php echo $id; ?>"> 
                                <?php 
                                    if ($data['idRubroPadre']=$level) { ?> &nbsp;&nbsp;&nbsp;<?php }
                                ?>

                                <?php echo $data['nombreRubro']; ?> </option>
                <?php if($level>$prelevel) {
                      $prelevel=$level;
                }
                $level++;
                buildTreeView_rubros($array, $id, $level, $prelevel);
                $level--;
          }
          
    }
    if($level == $prelevel) { ?>
          </li></ul>
    <?php }
}

?>