<?php

namespace Model;

class Rubro extends ActiveRecord {
    
    protected static $tabla= 'Rubros';
    protected static $columnasDB = [    'idRubro', 'idRubroPadre', 
                                        'nombreRubro', 'descripcionRubro',
                                        'ordenRubro', 'destacadoRubro', 
                                        'menuRubro', 'estadoRubro', 'esPadre'];
    
//  Se definen los atributos public (que serán las columnas de la tabla Rubros)
    public $idRubro;
    public $idRubroPadre;
    public $nombreRubro;
    public $descripcionRubro; 
    public $ordenRubro;
    public $destacadoRubro;
    public $menuRubro;
    public $estadoRubro;
    public $esPadre;

    public function __construct($args=[])
    {
        // La inicializacion de idRubro puede OMITIRSE
        if( isset($args['idRubro']) ) {$this->idRubro = intval($args['idRubro']);}
        else {$this->idRubro = 0;}
        //isset($args['idRubro']) ? $this->idRubro = intval($args['idRubro']) : $this->idRubro = 0;

        //echo("se evalua idRubroPadre<br>");
        if( isset($args['idRubroPadre']) ) {$this->idRubroPadre = intval($args['idRubroPadre']);}
        else {$this->idRubroPadre = NULL;}
        //echo($args['nombreRubro']);

        $this->nombreRubro = $args['nombreRubro'] ?? '' ;
        $this->descripcionRubro = $args['descripcionRubro'] ?? '' ;
                
        if( isset($args['ordenRubro']) ) {$this->ordenRubro = intval($args['ordenRubro']);}
        else {$this->ordenRubro = 0;}
        
        $this->destacadoRubro = $args['destacadoRubro'] ?? "" ;
        $this->menuRubro = $args['menuRubro'] ?? "" ;
        $this->estadoRubro = $args['estadoRubro'] ?? "" ;
        
        /*if( isset($args['esPadre']) ) {$this->esPadre = intval($args['esPadre']);}
        else {$this->esPadre = 'N';}*/ //se piensa que NO hace falta inicializar este atributo

    }//los campos de la instancia creada tendra valores que se le pasan en el array o tendrán ''


    public  function guardar() {
        // Para la INSERCION se utilizara prepare, bind_param y execute

        /*Hay 2 alternativas:
                                El rubro a crear NO tenga rubro padre
                                El rubro a crear sea un rubro hijo (tenga un rubro padre)*/
        if( $this->idRubroPadre==NULL ) {   //Se crea un rubro que NO tiene padre
                                            //o sea, que es Rubro de 1er orden

            //echo "Se creara rubro NO hijo<br>";
            //var_dump($this->idRubroPadre);
            //exit;

            $stmt = self::$db->prepare( "INSERT INTO    `Rubros` (  nombreRubro, descripcionRubro,
                                                                    ordenRubro, destacadoRubro,
                                                                    menuRubro, estadoRubro) 
                                                    VALUES ( ?, ?, ?, ?, ?, ? ) ;" );

            $stmt->bind_param("ssisss",     $this->nombreRubro, $this->descripcionRubro,
                                            $this->ordenRubro, $this->destacadoRubro, 
                                            $this->menuRubro, $this->estadoRubro);
            $stmt->execute();
                    
            if($stmt->affected_rows>0) {
                //echo "La insercion fue exitosa";
                return true;
            } else 
            {
                //echo "NO se pudo insertar";
                return false;
            }
            $stmt->close();
            self::$db->close();
            
        } else {//Se crea un rubro que tiene padre (Rubro Hijo)
            //El Rubro Padre es DECLARADO ahora como tal (se modificará su atributo esPadre)


            $stmt0 = self::$db->prepare( "UPDATE `Rubros` SET esPadre='S' WHERE idRubro = ?;" );

            $stmt0->bind_param("i",    $this->idRubroPadre);
            $stmt0->execute();



            //Creacion del Rubro Hijo
            $stmt = self::$db->prepare( "INSERT INTO    `Rubros` (  idRubroPadre, 
                                                                    nombreRubro, descripcionRubro,
                                                                    ordenRubro, destacadoRubro,
                                                                    menuRubro, estadoRubro) 
                                                    VALUES ( ?, ?, ?, ?, ?, ?, ?) ;" );

            $stmt->bind_param("ississs",    $this->idRubroPadre, 
                                            $this->nombreRubro, $this->descripcionRubro,
                                            $this->ordenRubro, $this->destacadoRubro, 
                                            $this->menuRubro, $this->estadoRubro);
            $stmt->execute();

            if($stmt->affected_rows>0) {
                //echo "La insercion fue exitosa";
                return true;
            } else 
            {
                //echo "NO se pudo insertar";
                return false;
            }
            $stmt->close();
            self::$db->close(); 
        }
        
        //Se CIERRAN el StateMent y la conexion a la base de datos de esta instancia
         //$stmt->close();
        // self::$db->close();
    }// FIN guardar()


    public function actualizar() {
        // echo "<pre>";
        // var_dump($this->nombreRubro);
        // var_dump($this->descripcionRubro);
        // var_dump($this->ordenRubro);
        // var_dump($this->destacadoRubro);
        // var_dump($this->menuRubro);
        // var_dump($this->estadoRubro);
        // var_dump($this->idRubro);
        // echo "</pre>";

        $stmt = self::$db->prepare( "UPDATE `Rubros` SET    nombreRubro= ?, descripcionRubro= ?,
                                                            ordenRubro= ?, destacadoRubro= ?,
                                                            menuRubro= ?, estadoRubro= ?
                                        WHERE   idRubro= ? ;" );

        $stmt->bind_param("ssisssi",    $this->nombreRubro, $this->descripcionRubro,
                                        $this->ordenRubro, $this->destacadoRubro, 
                                        $this->menuRubro, $this->estadoRubro, 
                                        $this->idRubro );

        /*$stmt = self::$db->prepare( "INSERT INTO    `Rubros` (  idRubroPadre, 
                                                                nombreRubro, descripcionRubro,
                                                                ordenRubro, destacadoRubro,
                                                                menuRubro, estadoRubro) 
                        VALUES ( ?, ?, ?, ?, ?, ?, ?) ;" );

        $stmt->bind_param("ississs",    $this->idRubroPadre, 
                                        $this->nombreRubro, $this->descripcionRubro,
                                        $this->ordenRubro, $this->destacadoRubro, 
                                        $this->menuRubro, $this->estadoRubro);*/


        /*$stmt = self::$db->prepare( "UPDATE Rubros SET nombreRubro= ? WHERE idRubro= ?;" );

        $stmt->bind_param("si", $this->nombreRubro, $this->idRubro );*/





        //debuguear($stmt);
        $stmt->execute();

        return true;
        // debuguear($stmt);

        //$stmt->affected_rows siempre devolvera 0, ESTO OCURRE CON UPDATE y supuestamente con DELETE
        if($stmt->affected_rows>0) {
            //echo "La actualizacion fue exitosa";
            return true;
        } else {
            //echo "NO se pudo actualizar";
            //return false;
            return true;
        }

        $stmt->close();
        self::$db->close(); 

        //echo "LUEGO DEL EXECUTE DE ACTUALIZAR";
        //echo $query;
        //debuguear($resultado);
    }//FIN actualizar()

    public function eliminar() {
        
        $stmt = self::$db->prepare( "DELETE FROM `Rubros` WHERE idRubro= ? LIMIT 1 ;" );
        $stmt->bind_param("i",    $this->idRubro );
        $stmt->execute();

        if($stmt->affected_rows>0) {
            //echo "La eliminacion fue exitosa";
            return true;
        } else {
            //echo "NO se pudo eliminar";
            return false;
        }

        $stmt->close();
        self::$db->close(); 
    }//FIN eliminar()






    //Listar todos los productos
    public static function all() {
        
        $query= "SELECT * FROM `Rubros`; ";
        $resultado= self::consultarSQL($query);
        //debuguear("antes del return");
        //debuguear($resultado);
        return $resultado;
    }

    //Busca un registro por idProducto
    public static function find($id) {
        $query = "SELECT * FROM " . static::$tabla . " WHERE " . static::$columnasDB[0] . " = ${id}";


        //debuguear($query);

        $resultado = self::consultarSQL($query);//$resultado guarda un vector con un objeto como elemento
        return array_shift($resultado);//retorna el elemento de la primera posicion del vector guardado en $resultado
    }


    //Listar todos los rubros que NO tienen padre
    public static function allTopLevel() {
    
    $query= "SELECT * FROM `Rubros`; ";
    $resultado= self::consultarSQL($query);
    //debuguear("antes del return");
    //debuguear($resultado);
    return $resultado;
}


    public static function consultarSQL($query)
    {
        //Consultar la BD con el query
        $resultado= self::$db->query($query);
        //Iterar los resultados (para obtenerlos a todos y no solo al ultimo que se trae)
              
        $array= [];
        while( $registro = $resultado->fetch_assoc() ) {
            $array[]= self::crearObjeto($registro); 
        }
        //Liberar la memoria
        $resultado->free();
        //retornar los resultados
        return $array;
    }

    /*  Toma cada arreglo de la funcion query() para crear objetos*/
    public static function crearObjeto($registro) {
        $objeto= new self;

        foreach($registro as $key => $value) {
            if( property_exists( $objeto, $key ) ) {
                $objeto->$key = $value;
            }
        }
        return $objeto;
    }
///////////////////////////////////////////////////////////////////////////////////
    public static function arrayTree() {
        $array= [];

        $query= "SELECT * FROM `Rubros`; ";
        
        //Consultar la BD con el query
        $resultado= self::$db->query($query);
        //Iterar los resultados (para obtenerlos a todos y no solo al ultimo que se trae)
        
        while( $registro = $resultado->fetch_assoc() ) {
            $array[$registro['idRubro']] ['nombreRubro']= $registro['nombreRubro']; 
            $array[$registro['idRubro']] ['idRubroPadre']= $registro['idRubroPadre']; 
            $array[$registro['idRubro']] ['esPadre']= $registro['esPadre']; 
        }
        //Liberar la memoria
        $resultado->free();
        //retornar los resultados
        return $array;
    }



////////////////////////////////////////////////////////////////////////////////////

/*  Esta funcion empata/mapea los atributos del objeto $producto con las llaves
    del arreglo args[] */
    public function sincronizar($args=[]) {
        foreach($args as $key => $value) {
            if( property_exists($this, $key) && !is_null($value)) {
                $this->$key = $value;
            }
        }
    }







}// FIN CLASE  Rubros




?>