<?php
namespace Model;

class Usuario extends ActiveRecord {
//  Se define en cada clase, un atributo que sera el nombre de la tabla a la cual la clase hace referencia
    protected static $tabla = 'Usuarios';   //se define un atributo estatico que indica a qué tabla hace referencia esta clase
    protected static $columnasDB = [    'idUsuario', 'idRol', 'nombres', 'apellidos',
                                        'usuario', 'password', 'token', 'emailUsuario',
                                        'intentosIngresarPassword', 'fechaUltimoIntentoIngresarPassword',
                                        'debeCambiarPassword', 'estadoUsuario', 'observacionesUsuario' ];
                                        //se define un array donde cada elemento será una columna de la tabla Usuarios
    
//  Errores de Validacion
    protected static $errores = [];

//  Se definen los atributos public que serán las columnas de la tabla Usuarios
    public $idUsuario;
    public $idRol;
    public $nombres;
    public $apellidos;
    public $usuario;
    public $password;
    public $token;
    public $emailUsuario;
    public $intentosIngresarPassword;
    public $fechaUltimoIntentoIngresarPassword;
    public $debeCambiarPassword;
    public $estadoUsuario;
    public $observacionesUsuario;

    public function __construct($args=[])
    {
        $this->idUsuario = $args['idUsuario'] ?? '' ;
        $this->idRol = $args['idRol'] ?? '' ;
        $this->nombres = $args['nombresUsuario'] ?? '' ;
        $this->apellidos = $args['apellidosUsuario'] ?? '' ;
        $this->usuario = $args['usuario'] ?? '' ;
        $this->password = $args['password'] ?? '' ;
        $this->token = $args['token'] ?? '' ;
        $this->emailUsuario = $args['emailUsuario'] ?? '' ;
        $this->intentosIngresarPassword = $args['intentosIngresarPassword'] ?? '' ;
        $this->fechaUltimoIntentoIngresarPassword = $args['fechaUltimoIntentoIngresarPassword'] ?? '' ;
        $this->debeCambiarPassword = $args['debeCambiarPassword'] ?? '' ;
        $this->estadoUsuario = $args['estadoUsuario'] ?? '' ;
        $this->observacionesUsuario = $args['observacionesUsuario'] ?? "" ;
    }//los campos de la instancia creada tendra valores que se le pasan en el array o tendrán ''

    public  function guardar() {
        //Hay valores definidos por defecto en la base de datos, com los que se intentaron incializar a continuacion:
        //$this->intentosIngresarPassword = 0;    //al crear un usuario, NO se intento ingresar la password
        //$this->debeCambiarPassword = 'N';




        /*$datosFormulario = $this->sanitizarDatos(); /*se obtiene un array de elementos llave-valor, donde
                                                    cada uno es columna+valor, donde cada valor esta sanitizado*/
        
        //debuguear($datosFormulario);
        /*$query= "   INSERT INTO `Usuarios`  (	idRol, nombres, apellidos, 
                                                usuario, password,
                                                token, emailUsuario, 
                                                observacionesUsuario    ) 
                    VALUES                  (   '$this->idRol', '$this->nombres', '$this->apellidos', 
                                                '$this->usuario', '$this->password',
                                                '$this->token', '$this->emailUsuario',
                                                '$this->observacionesUsuario' ); ";
        $resultado = self::$db->query($query);*/


        // Para la INSERCION se utilizara prepare, bind_param y execute
        $stmt = self::$db->prepare( "INSERT INTO    `Usuarios` (    idRol, nombres, apellidos, 
                                                                    usuario, password,
                                                                    token, emailUsuario, 
                                                                    observacionesUsuario) 
                                                    VALUES (    ?, ?, ?, ?, ?, ?, ?, ?) ;" );

        $stmt->bind_param("isssssss",   $this->idRol, $this->nombres, $this->apellidos, 
                                        $this->usuario, $this->password,
                                        $this->token, $this->emailUsuario,
                                        $this->observacionesUsuario);
        $stmt->execute();
        
        if($stmt->affected_rows>0) {
            //La insercion fue exitosa
            return true;
        } else 
        {
            //echo "NO se pudo insertar";
            //header('Location: crear-usuario.php');
            return false;
        }
        //Se CIERRAN el StateMent y la conexion a la base de datos de esta instancia
        $stmt->close();
        self::$db->close();
    }// FIN guardar()

 ///////////////////////////////////////////////////////////////////////////////////////////////////////
    /*Permite obtener un arreglo asociativo donde cada elemento será una dulpla llave-valor.
    Cada llave-valor será el campo del formulario + valor ingresado.
    > Se debe evitar el 1er elemento (idTabla) del array $columnasDB 
ya que NO existe sino hasta despues de la insercion o simplemente es IMPOSIBLE cambiarla (en actualizacion).
    > Esta funcion debe definirse para cada objeto diferente*/
    public function getAsosiativeArrayFromForm() {
        $assocArray= [];
        foreach( self::$columnasDB as $columna ) {
            if( $columna === 'idUsuario' ) continue;
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


    
}//Clase Usuario

?>