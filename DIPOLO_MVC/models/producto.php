<?php
namespace Model;

class Producto extends ActiveRecord {
//  Se define en cada clase, un atributo que sera el nombre de la tabla a la cual la clase hace referencia
    protected static $tabla = 'Productos';   //se define un atributo estatico que indica a qué tabla hace referencia esta clase
    protected static $columnasDB = [    'idProducto', 'idModelo', 'idRubro', 'idSubrubro', 'idMarca',
                                        'codigoProducto', 'nombreProducto', 'origen', 'descripcionProducto',
                                        'precioTachadoProducto', 'precioVentaProducto','precioListaProducto',
                                        'destacadoProducto', 'ordenProducto', 'vistasProducto',
                                        'stockProducto', 'condicion', 'estadoProducto' ];
                                        //se define un array donde cada elemento será una columna de la tabla Usuarios
    
//  Errores de Validacion
    protected static $errores = [];

//  Se definen los atributos public que serán las columnas de la tabla Usuarios
    public $idProducto;
    public $idModelo;
    public $idRubro;
    public $idSubrubro;
    public $idMarca;
    public $codigoProducto;
    public $nombreProducto;
    public $origen;
    public $descripcionProducto;
    public $precioTachadoProducto;
    public $precioVentaProducto;
    public $precioListaProducto;
    public $destacadoProducto;
    public $ordenProducto;
    public $vistasProducto;
    public $stockProducto;
    public $condicion;
    public $estadoProducto;

    public function __construct($args=[])
    {
        //$this->idProducto = $args['idProducto'] ?? '' ;
        if( isset($args['idProducto']) ) {$this->idProducto = intval($args['idProducto']);}
        else {$this->idProducto = 0;}

        //$this->idModelo = (intval($args['idModelo'])) ?? intval('0');
        if( isset($args['idModelo']) ) {$this->idModelo = floatval($args['idModelo']);}
        else {$this->idModelo = 0;}

        //$this->idRubro = intval($args['idRubro']);
        if( isset($args['idRubro']) ) {$this->idRubro = floatval($args['idRubro']);}
        else {$this->idRubro = 0;}
        
        //$this->idSubrubro = intval($args['idSubrubro']);
        if( isset($args['idSubrubro']) ) {$this->idSubrubro = floatval($args['idSubrubro']);}
        else {$this->idSubrubro = 0;}

        //$this->idMarca = intval($args['idMarca']);
        if( isset($args['idMarca']) ) {$this->idMarca = floatval($args['idMarca']);}
        else {$this->idMarca = 0;}

        $this->codigoProducto = $args['codigoProducto'] ?? '' ;
        $this->nombreProducto = $args['nombreProducto'] ?? '' ;
        $this->origen = $args['origen'] ?? '' ;
        $this->descripcionProducto = $args['descripcionProducto'] ?? '' ;
        
        if( isset($args['precioTachadoProducto']) ) {$this->precioTachadoProducto = floatval($args['precioTachadoProducto']);}
        else {$this->precioTachadoProducto = 0.00;}
        
        if( isset($args['precioVentaProducto']) ) {$this->precioVentaProducto = floatval($args['precioVentaProducto']);}
        else {$this->precioVentaProducto = 0.00;}
        
        if( isset($args['precioListaProducto']) ) {$this->precioListaProducto = floatval($args['precioListaProducto']);}
        else {$this->precioListaProducto = 0.00;}
        
        
        $this->destacadoProducto = $args['destacadoProducto'] ?? "" ;
        $this->ordenProducto = $args['ordenProducto'] ?? "" ;
        $this->vistasProducto = $args['vistasProducto'] ?? "" ;
        //$this->stockProducto = intval($args['stockProducto']);
        if( isset($args['stockProducto']) ) {$this->stockProducto = floatval($args['stockProducto']);}
        else {$this->stockProducto = 0;}

        $this->condicion = $args['condicion'] ?? "" ;
        $this->estadoProducto = $args['estadoProducto'] ?? "" ;

    }//los campos de la instancia creada tendra valores que se le pasan en el array o tendrán ''

    public  function guardar() {
        //Hay valores definidos por defecto en la base de datos, com los que se intentaron incializar a continuacion:
        




        /*$datosFormulario = $this->sanitizarDatos(); /*se obtiene un array de elementos llave-valor, donde
                                                    cada uno es columna+valor, donde cada valor esta sanitizado*/
        
        /*echo ("Se muestra el objeto Producto");
        echo ("<pre>");
        //var_dump($this->idProducto);
        echo "Marca: "; var_dump($this->idMarca);
        echo "Modelo: "; var_dump($this->idModelo);
        echo "Rubro: "; var_dump($this->idRubro);
        echo "Subrubro: "; var_dump($this->idSubrubro);
        echo "Nombre: "; var_dump($this->nombreProducto);
        echo "Codigo: "; var_dump($this->codigoProducto);
        echo "Origen: "; var_dump($this->origen);
        echo "Descripcion: "; var_dump($this->descripcionProducto);
        echo "Destacado: "; var_dump($this->destacadoProducto);
        echo "Orden: "; var_dump($this->ordenProducto);
        echo "Vistas: "; var_dump($this->vistasProducto);
        echo "Condicion: "; var_dump($this->condicion);
        echo "Estado: "; var_dump($this->estadoProducto);
        echo "Stock: "; var_dump($this->stockProducto);

        echo "Precio Tachado: "; var_dump($this->precioTachadoProducto);
        echo "Precio Venta: "; var_dump($this->precioVentaProducto);
        echo "Precio Lista: "; var_dump($this->precioListaProducto);
        echo ("</pre>");
        */

        // Para la INSERCION se utilizara prepare, bind_param y execute
        $stmt = self::$db->prepare( "INSERT INTO    `Productos` (   idModelo, idRubro, /*idSubrubro,*/ idMarca,
                                                                    codigoProducto, nombreProducto,
                                                                    origen, descripcionProducto,
                                                                    precioTachadoProducto, precioVentaProducto, precioListaProducto,
                                                                    destacadoProducto, ordenProducto, vistasProducto,
                                                                    stockProducto, condicion, estadoProducto) 
                                                    VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?) ;" );

        $stmt->bind_param("iiissssdddsiiiss",   $this->idModelo, $this->idRubro, /*$this->idSubrubro,*/ $this->idMarca,
                                                $this->codigoProducto, $this->nombreProducto,
                                                $this->origen, $this->descripcionProducto,
                                                $this->precioTachadoProducto, $this->precioVentaProducto, $this->precioListaProducto,
                                                $this->destacadoProducto, $this->ordenProducto, $this->vistasProducto, 
                                                $this->stockProducto, $this->condicion, $this->estadoProducto);
        $stmt->execute();
                
        if($stmt->affected_rows>0) {
            //La insercion fue exitosa
            return true;
        } else 
        {
            //echo "NO se pudo insertar";
            return false;
        }
        //Se CIERRAN el StateMent y la conexion a la base de datos de esta instancia
        $stmt->close();
        self::$db->close();
    }// FIN guardar()


    public function actualizar() {
        

        /*$stmt = self::$db->prepare("UPDATE `Productos` SET  idModelo= ?, idRubro= ? , idSubrubro= ?, idMarca= ?,
                                                            codigoProducto= ?, nombreProducto= ?,
                                                            origen= ?, descripcionProducto= ?,
                                                            precioTachadoProducto= ?, precioVentaProducto= ?, precioListaProducto= ?,
                                                            destacadoProducto= ?, ordenProducto= ?, vistasProducto= ?,
                                                            stockProducto= ?, condicion= ?, estadoProducto= ? 
                                    WHERE idProducto= ? ;");

        echo "LUEGO DEL PREPARE DE ACTUALIZAR<br>";

        $stmt->bind_param("iiiissssdddsiiissi", $this->idModelo, $this->idRubro, $this->idSubrubro, $this->idMarca,
                                                $this->codigoProducto, $this->nombreProducto,
                                                $this->origen, $this->descripcionProducto,
                                                $this->precioTachadoProducto, $this->precioVentaProducto, $this->precioListaProducto,
                                                $this->destacadoProducto, $this->ordenProducto, $this->vistasProducto, 
                                                $this->stockProducto, $this->condicion, $this->estadoProducto, 
                                                $this->idProducto);
        $stmt->execute();
        */

        $query= "UPDATE `Productos` SET  idModelo=".$this->idModelo.", idRubro=".$this->idRubro.", idMarca=".$this->idMarca.",
                                                            codigoProducto='".$this->codigoProducto."', nombreProducto='".$this->nombreProducto."',
                                                            origen='".$this->origen."', descripcionProducto='".$this->descripcionProducto."',
                                                            precioTachadoProducto=".$this->precioTachadoProducto.", precioVentaProducto=".$this->precioVentaProducto.", precioListaProducto=".$this->precioListaProducto.",
                                                            destacadoProducto='".$this->destacadoProducto."', ordenProducto=".$this->ordenProducto.", vistasProducto=".$this->vistasProducto.",
                                                            stockProducto=".$this->stockProducto.", condicion='".$this->condicion."', estadoProducto='".$this->estadoProducto."' 
                                    WHERE idProducto=".$this->idProducto.";" ;

        //debuguear($query);

        $resultado = self::$db->query($query);

        echo "LUEGO DEL EXECUTE DE ACTUALIZAR";

        debuguear($resultado);

}





 ///////////////////////////////////////////////////////////////////////////////////////////////////////
    /*Permite obtener un arreglo asociativo donde cada elemento será una dulpla llave-valor.
    Cada llave-valor será el campo del formulario + valor ingresado.
    > Se debe evitar el 1er elemento (idTabla) del array $columnasDB 
ya que NO existe sino hasta despues de la insercion o simplemente es IMPOSIBLE cambiarla (en actualizacion).
    > Esta funcion debe definirse para cada objeto diferente*/
    public function getAsosiativeArrayFromForm() {
        $assocArray= [];
        foreach( self::$columnasDB as $columna ) {
            if( $columna === 'idProducto' ) continue;
            $assocArray[$columna] = $this->$columna;
        }
        return $assocArray;
    }

 ///////////////////////////////////////////////////////////////////////////////////////////////////////
    /* Sanitiza los datos ingresados en formularios de crear-usuario.php y actualizar-usuario.php
    para EVITAR la inyeccion de codigo sql.
        Dicha funcion será llamada DENTRO de las funciones guardar() y actualizar()
    */
    public function sanitizarDatos() {
        $arrayDatosIngresados = $this->getAsosiativeArrayFromForm();
        $arrayDatosSanitizados = [];
        foreach($arrayDatosIngresados as $key=>$value) {
            $arrayDatosSanitizados[$key]= self::$db->escape_string($value);
        }
        return $arrayDatosSanitizados;
    }

    public static function  getErrores() {
        return self::$errores;
    }

 ///////////////////////////////////////////////////////////////////////////////////////////////////////
    public function validar() {
        //CONTROL de los campos vacios obligatorios
        if(!$this->idRol)                                   { self::$errores[]= 'Debes asignar un rol al usuario'; }
        if(!$this->nombres)                                 { self::$errores[]= 'Debes añadir el/los nombre/s del usuario'; }
        if(!$this->apellidos)                               { self::$errores[]= 'Debes añadir el/los apellido/s del usuario'; }
        if(!$this->usuario)                                 { self::$errores[]= 'Debes añadir el usuario'; }
        if(!$this->password || strlen($this->password)<4)   { self::$errores[]= 'Debes añadir una password de al menos 4 caracteres'; }
        if(!$this->emailUsuario)                            { self::$errores[]= 'Debes añadir el e-mail del usuario'; }
        
        return self::$errores;
    }// FIN validar

    //Listar todos los productos
    public static function all() {
        
        $query= "SELECT * FROM `Productos`; ";
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


/*  Esta funcion empata/mapea los atributos del objeto $producto con las llaves
    del arreglo args[] */
    public function sincronizar($args=[]) {
        foreach($args as $key => $value) {
            if( property_exists($this, $key) && !is_null($value)) {
                $this->$key = $value;
            }
        }
    }
    
}//Clase Producto

?>