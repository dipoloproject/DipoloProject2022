<?php

namespace Model;

class Producto extends ActiveRecord {

    protected static $tabla = 'Productos';
    protected static $columnasDB = ['idProducto', 'nombreProducto', 'imagen', 'descripcion', 'precio', 'color', 'peso', 'idCategoria'];

    public $idProducto;
    public $nombreProducto;
    public $imagen;
    public $descripcion;
    public $precio;
    public $color;
    public $peso;
    public $idCategoria;

    public function __construct($args=[])
    {
        $this->idProducto = $args['idProducto'] ?? NULL ;
        $this->nombreProducto = $args['nombreProducto'] ?? '' ;
        $this->imagen = $args['imagen'] ?? '' ;
        $this->descripcion = $args['descripcion'] ?? '' ;
        $this->precio = $args['precio'] ?? '' ;
        $this->color = $args['color'] ?? '' ;
        $this->peso = $args['peso'] ?? '' ;
        $this->idCategoria = $args['idCategoria'] ?? '' ;
    }

    public function validar() {
        //CONTROL de los campos vacios obligatorios
        if(!$this->nombreProducto) {
            self::$errores[]= 'Debes añadir NOMBRE al producto';
        }
        if(strlen($this->descripcion)<20) {
            self::$errores[]= 'Debes añadir una DESCRIPCION al producto de al menos 20 caracteres';
        }
        if(!$this->precio) {
            self::$errores[]= 'Debes añadir PRECIO al producto';
        }
        if(!$this->color) {
            self::$errores[]= 'Debes añadir COLOR al producto';
        }
        if(!$this->peso) {
            self::$errores[]= 'Debes añadir PESO al producto';
        }
        if(!$this->idCategoria) {
            self::$errores[]= 'Debes añadir CATEGORIA al producto';
        }
        if(!$this->imagen) {//controla que se suba una imagen y sin error
            self::$errores[]= 'Debes añadir una IMAGEN del producto';
        }
        // //Validar por tamaño de imagen (1MB como maximo)
        // $medida = 1000 * 1000;

        // if( $this->imagen['size'] > $medida ) {
        //     self::$errores[] = 'La imagen es muy PESADA';
        // }
        return self::$errores;
    }//validar


    
}//Clase Producto

?>