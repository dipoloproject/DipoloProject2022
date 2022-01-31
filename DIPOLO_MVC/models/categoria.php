<?php

namespace Model;

class Categoria extends ActiveRecord {

    protected static $tabla = 'Categorias';
    protected static $columnasDB = ['idCategoria', 'nombreCategoria'];

    public $idCategoria;
    public $nombreCategoria;

    public function __construct($args=[])
    {
        $this->idCategoria = $args['idCategoria'] ?? NULL ;
        $this->nombreCategoria = $args['nombreCategoria'] ?? '' ;
    }

    public function validar() {
        //CONTROL de los campos vacios obligatorios
        if(!$this->nombreCategoria) {
            self::$errores[]= 'Debes añadir NOMBRE a la categoria';
        }

        return self::$errores;
    }//validar


}//Categoria


?>