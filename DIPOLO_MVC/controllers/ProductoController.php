<?php
namespace Controllers;
use MVC\Router;
use Model\Producto;
use Model\Categoria;
use Intervention\Image\ImageManagerStatic as Image;

class ProductoController {
    
    public static function index(Router $router) {
        $productos = Producto::all();
        
        $creado = $_GET['creado'] ?? NULL;

        $router->render('productos/admin', [
            'productos' => $productos,
            'creado' => $creado
        ]);
    }

    public static function crear(Router $router) {
        $producto = new Producto;
        $categorias = Categoria::all();


        //Arreglo con mensajes de errores
        $errores = Producto::getErrores();

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $producto = new Producto($_POST);

            //Generar NOMBRE UNICO para imagen
            $nombreImagen = md5( uniqid( rand(), true) ) . ".jpg" ;
            //SETEAR la imagen
            //Realiza un resize a la imagen con Intervention
            if($_FILES['imagen']['tmp_name']) {
                $image = Image::make($_FILES['imagen']['tmp_name'])->fit(800,600);
                $producto->setImagen($nombreImagen);
            }
            
            //VALIDAR
            $errores = $producto->validar();
            //Revisar que el arreglo errores este VACIO
            if(empty($errores)) {          
                //Crear carpeta para subir imagenes
                if(!is_dir(CARPETA_IMAGENES)) {
                    mkdir(CARPETA_IMAGENES);
                }
                //Guarda la imagen en el servidor
                $image->save(CARPETA_IMAGENES . $nombreImagen);
                
                //Guarda en la base de datos
                //$resultado = $producto->guardar();

                $producto->guardar();
                // //Mensaje de exito o error
                // if($resultado) {
                //     //echo "Producto insertado CORRECTAMENTE =)";
                //     //se va a REDIRECCIONAR al usuario para evitar que hagan doble click y se inserten datos duplicados
                //     header('Location: /admin?creado=1');//se le pasa un querystring

                // } else {
                //     echo "NO se pudo insertar el producto >=(";
                // }
            }//if(empty($errores))

        }

        $router->render('productos/crear', [
            'producto' => $producto,
            'categorias' => $categorias,
            'errores' => $errores
        ]);
    }

    public static function actualizar(Router $router) {
        $id = validarORedireccionar('/admin');

        $producto = Producto::find($id);
        $categorias = Categoria::all();

        $errores = Producto::getErrores();

        //Metodo POST para actualizar
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Asignar los atributos
            $args = [];
            $args['nombreProducto'] = $_POST['nombreProducto'] ?? null;
            $args['imagen'] = $_POST['imagen'] ?? null;
            $args['descripcion'] = $_POST['desripcion'] ?? null;
            $args['precio'] = $_POST['precio'] ?? null;
            $args['color'] = $_POST['color'] ?? null;
            $args['peso'] = $_POST['peso'] ?? null;
    
            $producto->sincronizar($args);
            //Validacion
            $errores = $producto->validar();
            //SUBIDA de archivos
    
            //Generar nombre unico para la  imagen
            $nombreImagen = md5( uniqid( rand(), true) ) . ".jpg" ;
    
            if($_FILES['imagen']['tmp_name']) {
                $image = Image::make($_FILES['imagen']['tmp_name'])->fit(800,600);
                $producto->setImagen($nombreImagen);
            }
    
            //Revisar que el arreglo errores este VACIO
            if(empty($errores)) {
                if($_FILES['imagen']['tmp_name']) {
                    //ALMACENAR IMAGEN 
                    $image->save(CARPETA_IMAGENES . $nombreImagen);
                }
                $producto->guardar();
            }//if(empty($errores))
        }//if


        $router->render('/productos/actualizar', [
            'producto' => $producto, 
            'errores' => $errores, 
            'categorias' => $categorias
        ]);
        
    }

    public static function eliminar() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {//si se hizo click en ELIMINAR, se envia un POST
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);
    
            if($id) {
                $tipo = $_POST['tipo'];
                if( validarTipoContenido($tipo) ) {
                        $producto = Producto::find($id);
                        $producto->eliminar();                    
                }
            }
        }
    }//eliminar


}//ProductoController




?>