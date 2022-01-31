<?php

namespace Controllers;
use MVC\Router;
use Model\Admin;

class LoginController {
    public static function login(Router $router) {
        
        $router->renderAdmin('auth/login', [

        ]);
    }
    
    public static function logout() {
        echo "DESDE LOGOUT";
    }
}


?>