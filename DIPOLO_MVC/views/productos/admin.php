<main class="contenedor-centrado">
        <h1>ADMINISTRADOR DE DIPOLO</h1>

        <!-- MUESTRA mensaje de notificacion -->
        <?php 
        
        if($creado) {
            $mensaje = mostrarNotificacion( intval($creado) ); 
            if( $mensaje) { ?>
                <p class="alerta exito">
                    <?php echo S($mensaje) ?>
                </p>
    <?php    }
        }
    ?>
        

        <a href="/productos/crear" class="boton-verde">Nuevo Producto</a>
        <a href="/admin/categorias/crear.php" class="boton-naranja">Nueva Categoria</a>

        <h2>Productos</h2>
        <table class="productos">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre del Producto</th>
                    <th>Imagen</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody><!-- Mostrar resultados de la BD -->
                <?php foreach( $productos as $producto ): ?>
                <tr>
                    <td> <?php echo $producto->idProducto ; ?> </td>
                    <td> <?php echo $producto->nombreProducto ; ?></td>
                    <td><img src="/imagenes/<?php echo $producto->imagen; ?>" class="imagen-tabla"></td>
                    <td> $ <?php echo $producto->precio ; ?> </td>
                    <td>
                        <form method="POST" class="w-100" action="/productos/eliminar">
                            <input type="hidden" name="id" value="<?php echo $producto->idProducto; ?>">
                            <input type="hidden" name="tipo" value="producto">

                            <input type="submit" class="boton-rojo" value="Eliminar">
                        </form>
                        
                        <a href="/productos/actualizar?id=<?php echo $producto->idProducto;?>" class="boton-naranja">Actualizar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

</main>