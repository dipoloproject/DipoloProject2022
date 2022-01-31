<?php

namespace MVC;

class Router {

    public $rutasGET = [];
    public $rutasPOST = [];

    public function get($url, $fn) {
        $this->rutasGET[$url] = $fn;
    }

    public function post($url, $fn) {
        $this->rutasPOST[$url] = $fn;
    }

    public function comprobarRutas()
    {
        $urlActual = $_SERVER['PATH_INFO'] ?? '/';//para conocer la url actual
        $metodo = $_SERVER['REQUEST_METHOD'];

        if($metodo === 'GET') {
            $fn = $this->rutasGET[$urlActual] ?? NULL;
        } else {
            $fn = $this->rutasPOST[$urlActual] ?? NULL;
        }

        if($fn) {
            //La URL existe y hay una funcion asociada
            call_user_func($fn, $this);
        } else {
            echo "Pagina NO encontrada";//o direcionar a pagina 404
        }
    }//comprobarRutas

    //Muestra una vista
    public function render($view, $datos = []) {

        foreach($datos as $key => $value) {
            $$key = $value;
        }

        ob_start();
        include __DIR__ . "/views/$view.php";
        $contenido = ob_get_clean();

        include __DIR__ . "/views/layout.php";
    }

    //Muestra una vista
    public function renderAdmin($view, $datos = []) {

        foreach($datos as $key => $value) {
            $$key = $value;
        }

        //ob_start();
        //include __DIR__ . "/views/$view.php";
        //$contenido = ob_get_clean();

        include __DIR__ . "/views/$view.php";
    }



}//clase Router

?>