<fieldset>
    <legend>Informacion General</legend>

    <label for="nombreProducto">Nombre del producto:</label>
    <input type="text" id="nombreProducto" name="nombreProducto" placeholder="Nombre del producto" value="<?php echo S($producto->nombreProducto); ?>">

    <label for="imagen">Imagen:</label>
    <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen">
    <!-- accept es para que solo se pueda subri archivos jpeg y png-->
    <?php if($producto->imagen) { ?>
        <img src="/imagenes/<?php echo $producto->imagen; ?>" class="imagen-small">
    <?php };?>
    
    <label for="descripcion">Descripcion:</label>
    <textarea id="descripcion" name="descripcion"> <?php echo s($producto->descripcion); ?> </textarea>

    <label for="precio">Precio del producto:</label>
    <input type="number" id="precio" name="precio" placeholder="Precio del producto" value="<?php echo s($producto->precio); ?>" >

    <label for="color">Color del producto:</label>
    <input type="text" id="color" name="color" placeholder="Color del producto" value="<?php echo s($producto->color); ?>" >

    <label for="peso">Peso del producto:</label>
    <input type="number" id="peso" name="peso" placeholder="Peso del producto" value="<?php echo s($producto->peso); ?>" >

</fieldset>

<fieldset>
    <legend>Categoria</legend>
        <label for="categoria">Categoria</label>
        <select name="idCategoria" id="categoria">
            <option selected value="">-- Seleccione --</option>
            <?php foreach($categorias as $categoria) { ?>
                <option 
                    <?php echo $producto->idCategoria === $categoria->idCategoria ? 'selected' : ''; ?>
                    value="<?php echo S($categoria->idCategoria); ?>"> <?php echo s($categoria->nombreCategoria); ?> </option>
            <?php } ?>
        </select>
</fieldset>