<article class="text-center">
    <form method="POST" class="form grid-half">
        <h2><?php echo $page_title;?></h2>
        
        <?php if(flash_has("error")):?>
        <div class="alert-error">
            <?php echo flash_show("error");?>
        </div>
        <?php endif;?>

        <div class="input-group grid-row">
            <label class="input-label">Nombre: </label><input class="input-field" type="text" name="nombre">
        </div>
        <div class="input-group grid-row">
            <label class="input-label">Area: </label><input class="input-field" type="text" name="area">
        </div>
        <div class="input-group grid-row">
            <label class="input-label">Accion: </label><input class="input-field" type="text" name="accion">
        </div>
        <br>
        <div class="input-group grid-row">
            <button class="btn-green" type="submit">Crear</button>
            <a class="btn-blue" href="/permisos">Volver</a>
        </div>
    </form>
</article>
