<?php

// VERIFICAR SI SE QUISO CERRAR SESIÓN al visitar este archivo
  session_start();  //se toma la sesión actual para poder leer $_GET
  if( isset($_GET['cerrar_sesion']) ) {//si existe la variable y es TRUE, es porque se quiso cerrar sesión
    session_destroy();  //se destruye la sesión que estaba iniciada
  }
/*A este segmento de codigo se ingresa luego de hacer CLICK en el boton de CERRAR SESIÓN en cualquier pagina*/
//


      include_once 'funciones/funciones.php';

      include_once 'templates/header.php';
      //include_once 'templates/barra.php';
      //include_once 'templates/navegacion.php';
?>

<body class="hold-transition login-page">

    <div class="login-box">
      <div class="login-logo">
        <!-- <a href="/"><img class="logo" src="/src/images/logo-DIPOLO-edited.png"></a> -->
        <a href="../index.php"><b>DIPOLO</b></a>
      </div>
      <!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Inicia Sesión aquí</p>

        <form action="action-login.php" method="post" name="login-admin-form" id="login-admin">
              <div class="form-group has-feedback">
                <input type="text" class="form-control" name="usuario" placeholder="Usuario" id="usuario_respuesta">
                <span class="glyphicon glyphicon-user form-control-feedback"></span> <!-- <span class="glyphicon glyphicon-envelope form-control-feedback"></span> -->
              </div>
              <div class="form-group has-feedback">
                <input type="password" class="form-control" name="password" placeholder="Contraseña">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
              </div>
              <div class="row">
                <!-- /.col -->
                <div class="col-xs-12">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Iniciar Sesión</button>
                    <input type="hidden" name="button-login-admin">
                </div><!-- /.col-xs-12 -->
                <!-- /.col -->
              </div><!-- /.row -->
        </form>

      </div>
      <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->

</body>
<?php
      include_once 'templates/footer.php';
?>
