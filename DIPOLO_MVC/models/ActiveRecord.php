<?php

namespace Model;

class ActiveRecord {

    //Base de Datos
    protected static $db;
    protected static $columnasDB = [];

    protected static $tabla = '';

    //Errores o validacion
    protected static $errores = [];

    //Definir la conexion a la BD
    public static function setDB($database) {   //$database proviene de la funcion conectarDB() utilizada en app.php  y definida en database.php
        self::$db = $database;
    }
   

    /*public function guardar() {
        if(static::$columnasDB[0] == "idProducto") {
            if( !is_null($this->idProducto) ) {
                //se esta acutalizando un registro
                $this->actualizar();
            } else {
                //Se esta creando un nuevo registro
                $this->crear();
            }
        } else if(static::$columnasDB[0] == "idCategoria") {
            if( !is_null($this->idCategoria) ) {
                //se esta acutalizando un registro
                $this->actualizar();
            } else {
                //Se esta creando un nuevo registro
                $this->crear();
            }
        }//con esto se sabe cuál clase esta llamando al metodo



        // if( !is_null($this->idProducto) ) {
        //     //se esta acutalizando un registro
        //     $this->actualizar();
        // } else {
        //     //Se esta creando un nuevo registro
        //     $this->crear();
        // }
    }//GUARDAR*/

    public function crear() {
        //echo "Guardando en la Base de Datos";
        //SANITIZAR DATOS
        $atributos = $this->sanitizarAtributos();

        //$string = join(', ', array_keys($atributos));//se obtiene un string con los elementos de un arreglo

        //INSERTAR en la BD
        //las 2 siguientes lienas de codigo seran reemplazadas por lo que les sigue
        // $query = " INSERT INTO Productos (idCategoria, nombreProducto, imagen, descripcion, precio, color, peso) 
        // VALUES ('$this->idCategoria', '$this->nombreProducto', '$this->imagen', '$this->descripcion', '$this->precio', '$this->color', '$this->peso') ";
        $query = " INSERT INTO " . static::$tabla . " ( ";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES (' "; 
        $query .= join("', '", array_values($atributos));
        $query .= " ') ";
        //debuguear($query);
        $resultado = self::$db->query($query);
        //debuguear($resultado);
        //return $resultado;
        if($resultado) {
            //se va a REDIRECCIONAR al usuario para evitar que hagan doble click y se inserten datos duplicados
            header('Location: /admin?creado=1');//se le pasa un querystring
        } else {
            echo "ERROR";
        }
    }//CREAR

    public function actualizar() {
        //SANITIZAR DATOS
        $atributos = $this->sanitizarAtributos();

        $valores = [];
        foreach($atributos as $key => $value) {
            $valores[] = "{$key}='{$value}'";
        }

        if(static::$columnasDB[0] === "idProducto") {
            $query = "UPDATE " . static::$tabla . " SET ";
            $query .= join(', ', $valores);
            $query .= "WHERE idProducto = '" . self::$db->escape_string($this->idProducto) . "' ";
        } else /*if(static::$columnasDB[0] === "idCategoria")*/ {
            $query = "UPDATE " . static::$tabla . " SET ";
            $query .= join(', ', $valores);
            $query .= "WHERE idCategoria = '" . self::$db->escape_string($this->idCategoria) . "' ";
        }//con esto se sabe cuál clase esta llamando al metodo

        // $query = "UPDATE " . static::$tabla . " SET ";
        // $query .= join(', ', $valores);
        // $query .= "WHERE idProducto = '" . self::$db->escape_string($this->idProducto) . "' ";

        $resultado = self::$db->query($query);
        
        if($resultado) {
            //echo "Producto insertado CORRECTAMENTE =)";
            //se va a REDIRECCIONAR al usuario para evitar que hagan doble click y se inserten datos duplicados
            header('Location: /admin?creado=2');//se le pasa un querystring

        } else {
            echo "NO se pudo actualizar el producto >=(";
        }
        //return $resultado;
    }

    
    //ELIMINAR REGISTRO
    public function eliminar() {
        //$query = "DELETE FROM " . static::$tabla . " WHERE " . static::$columnasDB[0] . " = '" . self::$db->escape_string($this->idCategoria) . "' LIMIT 1";
        
        //Hay que diferenciar cual clase Categoria o Producto esta llamando al metodo
        if(static::$columnasDB[0] == "idProducto") {
            $identificador = self::$db->escape_string($this->idProducto);
        } else if(static::$columnasDB[0] == "idCategoria") {
            $identificador = self::$db->escape_string($this->idCategoria);
        }//con esto se sabe cuál clase esta llamando al metodo
        

        $query = "DELETE FROM " . static::$tabla . " WHERE " . static::$columnasDB[0] . " = '" .  $identificador . "' LIMIT 1";
        //debuguear($query);
        
        $resultado = self::$db->query($query);
        if($resultado) {
            $this->borrarImagen();
            header('Location: /admin?creado=3');
        }
    }


    public function atributos() {//para guardar en un arreglo los campos llenados del formulario
        $atributos = [];
        foreach(static::$columnasDB as $columna) {
            //if($columna === 'idProducto' || $columna === 'idCategoria') continue;
            $atributos[$columna] = $this->$columna;
        }
        array_splice($atributos, 0, 1);//eliminina el 1er elemento llave-valor del arreglo
        //debuguear($atributos);
        return $atributos;
    }

    public function sanitizarAtributos() {
        $atributos = $this->atributos();
        $sanitizado = [];

        foreach($atributos as $key => $value) {
            $sanitizado[$key] = self::$db->escape_string($value);
        }
        return $sanitizado;
    }

    //Subida de archivos
    public function setImagen($imagen) {
        //Elimina la imagen previa
        if( !is_null($this->idProducto) ) {//esta seccion de codigo elimina imagen anterior en caso de estaa en pagina de actualizar
            //Comprobar si existe el archivo
            $this->borrarImagen();
        }
        //Asignar al atributo imagen el nombre $imagen
        if($imagen) {
            $this->imagen = $imagen;
        }
    }//setImagen

    //Eliminar archivo
    public function borrarImagen() {
        //Comprobar si existe el archivo
        $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);
        if($existeArchivo) {
            unlink(CARPETA_IMAGENES . $this->imagen);
        }
    }

    //Validacion
    public static function getErrores() {
        return static::$errores;
    }

    public function validar() {
                static::$errores = [];//se limpia el arreglo $errores
                return static::$errores;
    }

    //Lista todos los registros
    public static function all() {
        $query = "SELECT * FROM " . static::$tabla;
        $resultado = self::consultarSQL($query);//$resultado guarda el vector de objetos, cada objeto es una fila del resultSet
        return $resultado;
    }

    //Obtiene determinado numero de registros
    public static function get($cantidad) {
        $query = "SELECT * FROM " . static::$tabla . " LIMIT " . $cantidad;
        $resultado = self::consultarSQL($query);//$resultado guarda el vector de objetos, cada objeto es una fila del resultSet
        return $resultado;
    }

    //Busca un registro por idProducto
    public static function find($id) {
        $query = "SELECT * FROM " . static::$tabla . " WHERE " . static::$columnasDB[0] . " = ${id}";


        //debuguear($query);

        $resultado = self::consultarSQL($query);//$resultado guarda un vector con un objeto como elemento
        return array_shift($resultado);//retorna el elemento de la primera posicion del vector guardado en $resultado
    }

    public static function consultarSQL($query) {
        //Consultar BD
        $resultado = self::$db->query($query);//$resultado guarda la respuesta de la consulta (vector de vectores asociativos)
        //Iterar resultados
        $array = [];
        while( $registro = $resultado->fetch_assoc() ) {//$registro guarda cada vector asociativo
            $array[] = static::crearObjeto($registro);//a cada vector asociativo se lo convierte en un objeto y se lo añade como un elemento de $array
        }
        //Liberar memoria
        $resultado->free();//ayuda al servidor a liberar memoria (se puede omitir esta linea)
        //Retornar los resultados formateados
        return $array;//se retona un arreglo de objetos como elementos
    }

    
    public static function crearObjeto($registro) {
        $objeto = new static;//crea un objeto de clase actual (Producto)
        foreach($registro as $key => $value) {//al vector asociativo se lo mira como llave-valor
            if( property_exists($objeto, $key) ) {//cada atributo de $objeto se corresponde con la  llave del  vector asociativo $regitro
                $objeto->$key = $value;
            }
        }
        return $objeto;
    }//crearObjeto

    //Sincronizar el objeto en memoria con los cambios realizados por el usuario
    public function sincronizar($args=[]) {
        foreach($args as $key => $value) {
            if( property_exists($this, $key) && !is_null($value)) {
                $this->$key = $value;
            }
        }
    }
}//ActiveRecord




?>
