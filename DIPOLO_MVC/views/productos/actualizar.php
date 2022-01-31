<main class="contenedor-centrado">
        <h1>ACTUALIZAR Producto</h1>

        <?php foreach($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>    
        <?php endforeach; ?>

        <a href="/admin" class="boton-verde">Volver</a>

        <form class="formulario" method="POST" enctype="multipart/form-data">
            <?php include __DIR__ . '/formulario.php'; ?>
            <input type="submit" value="Actualizar Producto" class="boton-verde">
        </form>

</main>