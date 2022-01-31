<?php
    //por si la sesion ya estaba iniciada o no. arranca la  sesion o la ignora
    if(!isset($_SESSION)) {
        session_start();
    }//es bueno tener esto porque el  header esta en todas las paginas
    $auth = $_SESSION['login'] ?? false;//si el usuario esta autenticado tendra el login como true, auth sera true, sino, auth  sera null

    if(!isset($inicio)) {
        $inicio = FALSE;
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="preload" href="../build/css/app.css" as="style"><!-- Para que cargue la hoja de estilos lo mas rapido que pueda -->
                                                            <!-- Esto mejora la performance del sitio web -->
    <link rel="stylesheet" href="../build/css/app.css">

    <link rel="icon" type="image/png" href="favicon.png">
    <title>DIPOLO</title>
</head>

<body>
    <header class="header">
        <div class="background-header-contenido-superior">
            <div class="header-contenido-superior contenedor-centrado">
                <div class="empresa-logo-nombre">
                    <a href="/"><img class="logo" src="/src/images/logo-DIPOLO.png"></a>
                    <a href="/">Dipolo</a>
                <!-- href="/" indica que el enlace llevará a la pagina principal -->
                </div><!-- nombre y logo de la empresa -->
    
                <div class="datos-contacto"><!-- Telefono, Whatsapp y Correo electronico -->
                    <div class="dato_icono-valor">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-phone" width="40" height="40" viewBox="0 0 24 24" stroke-width="1.5" stroke="#7bc62d" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2" />
                        </svg><!-- svg de telefono -->
                        <p>(0381) 4276926</p>
                    </div><!-- telefono -->
    
                    <div class="dato_icono-valor">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-whatsapp" width="40" height="40" viewBox="0 0 24 24" stroke-width="1.5" stroke="#00b341" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M3 21l1.65 -3.8a9 9 0 1 1 3.4 2.9l-5.05 .9" />
                            <path d="M9 10a0.5 .5 0 0 0 1 0v-1a0.5 .5 0 0 0 -1 0v1a5 5 0 0 0 5 5h1a0.5 .5 0 0 0 0 -1h-1a0.5 .5 0 0 0 0 1" />
                        </svg><!-- svg de whatsapp -->
                        <p>(0381) 153312204</p>
                    </div><!-- whatsapp -->
    
                    <div class="dato_icono-valor">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-mail" width="36" height="36" viewBox="0 0 24 24" stroke-width="2" stroke="#ffbf00" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <rect x="3" y="5" width="18" height="14" rx="2" />
                            <polyline points="3 7 12 13 21 7" />
                          </svg><!-- svg de correo electronico -->
                        <p>info@dipolo.com.ar</p>
                    </div><!-- correo electronico -->
                </div><!-- datos de contacto -->
                <!-- los iconos son de tablericons, size 36px, stroke 2px -->
            </div><!-- header-contenido-superior contenedor-centrado -->
            
            <!-- HTML del menu de hamburguesa -->
            <!-- <div class="menu-hamburguesa">
                <span></span>
                <span></span>
                <span></span>
            </div> -->

        </div><!-- background-header-contenido-superior -->

        <!-- Barra de navegacion principal -->
        <div class="background-navegacion-principal">
            <div class="navegacion-principal-contenedor contenedor-centrado">
                <div class="navegacion-principal-enlaces">
                            <a href="index.php"><img class="logo" src="/src/images/home.png"></a>
                            <a class="enlaces-nologo" href="#">Categorías</a>
                            <a class="enlaces-nologo" href="#">Productos</a>
                            <a class="enlaces-nologo" href="#">Más vendidos</a>
                            <a class="enlaces-nologo" href="#">Novedades</a>
                            <a class="enlaces-nologo" href="#">Consultas</a>
                            
                            <?php if($auth): ?>
                                <a class="enlaces-nologo" href="cerrar-sesion.php">Cerrar Sesión</a>
                            <?php endif; ?>
                </div><!-- enlaces de navegacion principal -->

                    <!-- Campo BUSCAR -->
                    <div class="buscar-contenido">
                        <form>
                            <input  class="buscar"
                                    type="text" placeholder="Buscar"/>
                        </form><!-- campo Buscar -->
                    </div>
            </div><!-- navegacion-principal-contenedor -->
        </div><!-- background-navegacion-principal -->

    </header>




<!-- Se declara una variable a la cual se le pasara cierto contenido especifico -->
<?php echo $contenido; ?>




    <!-- FOOTER -->
<footer>
        <div class="background-footer">
            <div class="footer-contenido contenedor-centrado">
                <p>Todos los derechos reservados <?php echo date('Y'); ?> &copy;</p>
            </div>
        </div>
    </footer>

    

    <script src="../build/js/bundle.js"></script>
</body>
</html>