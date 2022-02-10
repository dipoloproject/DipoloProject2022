<?php

namespace Model;

class Rol extends ActiveRecord {
    
    protected static $tabla= 'Roles';
    protected static $columnasDB = [    'idRol', 
                                        'nombreRol', 'estadoRol',
                                        'observacionesRol'];
    
//  Se definen los atributos public (que serán las columnas de la tabla Rubros)
    public $idRol;
    public $nombreRol;
    public $estadoRol;
    public $observacionesRol; 

    public function __construct($args=[])
    {
        // La inicializacion de idRubro puede OMITIRSE
        if( isset($args['idRol']) ) {$this->idRol = intval($args['idRol']);}
        else {$this->idRol = 0;}
        //isset($args['idRubro']) ? $this->idRubro = intval($args['idRubro']) : $this->idRubro = 0;

        $this->nombreRol = $args['nombreRol'] ?? '' ;
        $this->estadoRol = $args['estadoRol'] ?? '' ;
        $this->observacionesRol = $args['observacionesRol'] ?? '' ;
        
        /*if( isset($args['esPadre']) ) {$this->esPadre = intval($args['esPadre']);}
        else {$this->esPadre = 'N';}*/ //se piensa que NO hace falta inicializar este atributo

    }//los campos de la instancia creada tendra valores que se le pasan en el array o tendrán ''


    public  function guardar() {
        // Para la INSERCION se utilizara prepare, bind_param y execute

        /*Hay 2 alternativas:
                                El rubro a crear NO tenga rubro padre
                                El rubro a crear sea un rubro hijo (tenga un rubro padre)*/
        
        $stmt = self::$db->prepare( "INSERT INTO    `Roles` (  nombreRol, estadoRol,
                                                                observacionesRol) 
                                                VALUES ( ?, ?, ?) ;" );

        $stmt->bind_param("sss",        $this->nombreRol, $this->estadoRol,
                                        $this->observacionesRol);
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
              
        //Se CIERRAN el StateMent y la conexion a la base de datos de esta instancia
         //$stmt->close();
        // self::$db->close();
    }// FIN guardar()


    public function actualizar() {
        //echo "<pre>";
        //var_dump($this->nombreRol);
        //var_dump($this->estadoRol);
        //var_dump($this->observacionesRol);
        //var_dump($this->idRol);
        // var_dump($this->menuRubro);
        // var_dump($this->estadoRubro);
        // var_dump($this->idRubro);
        //echo "</pre>";

        $stmt = self::$db->prepare( "UPDATE `Roles` SET    nombreRol= ?, estadoRol= ?,
                                                            observacionesRol= ?
                                        WHERE   idRol= ? ;" );

        $stmt->bind_param("sssi",    $this->nombreRol, $this->estadoRol,
                                        $this->observacionesRol, $this->idRol);

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

        $stmt->bind_param("si", $this->nombreRubro, $this->idRubro );





        //debuguear($stmt);*/
        $stmt->execute();

        return true;
        // debuguear($stmt);

        //$stmt->affected_rows siempre devolvera 0, ESTO OCURRE CON UPDATE y supuestamente con DELETE
        /*if($stmt->affected_rows>0) {
            //echo "La actualizacion fue exitosa";
            return true;
        } else {
            //echo "NO se pudo actualizar";
            //return false;
            return true;
        }
*/
        $stmt->close();
        self::$db->close(); 

        //echo "LUEGO DEL EXECUTE DE ACTUALIZAR";
        //echo $query;
        //debuguear($resultado);*/
    }//FIN actualizar()

    /*public function eliminar() {
        
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

*/




    //Listar todos los productos
    public static function all() {
        
        $query= "SELECT * FROM `Roles`; ";
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