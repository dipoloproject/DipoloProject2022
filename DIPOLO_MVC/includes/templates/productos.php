<?php
    //Importar conexion a la BD
    //require __DIR__ . '/../config/database.php';
    //$db = conectarDB();
    //Consultar la BD
    //$query = "SELECT * FROM Productos LIMIT ${limite}";
    //Obtener los resultados
    //$resultado = mysqli_query($db, $query);

    use App\Producto;
    
//ESTO es para indicar cuatnos productos mostrar de acuerdo a la pagina a la que se esta dirigiendo
    if($_SERVER['SCRIPT_NAME'] === '/productos.php') {
        $productos = Producto::all();
    } else {
        $productos = Producto::get(1);
    }

?>

<div class="productos-contenido">

            <?php foreach($productos as $producto) { ?>

                <div class="card">

                    <img loading="lazy" src="/imagenes/<?php echo $producto->imagen ;?>" alt="imagen mouse">
                        <!-- <source srcset="src/images/producto1.jpg" type="image/jpeg"> -->
                    
                    <div class="card-contenido">
                        <h3><?php echo $producto->nombreProducto ;?></h3>
                        <p><?php echo $producto->descripcion ;?></p>
                        <p class="precio"><?php echo $producto->precio ;?></p>
                        <ul class="iconos-caracteristicas">
                            <li>
                                <img loading="lazy" src="src/images/icono-color.svg" alt="icono color"></img>
                                <p><?php echo $producto->color ;?></p>
                            </li>
                            <li>
                                <img loading="lazy" src="src/images/icono-peso.svg" alt="icono peso"></img>
                                <p> <?php echo $producto->peso ; ?> gr</p>
                            </li>
                        </ul>

                        <a href="producto.php?id=<?php echo $producto->idProducto ;?>" class="boton boton-amarillo">Ver producto</a>

                    </div><!-- card-contenido -->
                </div><!-- card -->
            <?php } ?>

            
</div><!-- productos-contenido -->

