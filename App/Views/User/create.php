<article class="text-center">
    <form method="POST" class="form grid-9">
        <h2><?php echo $page_title;?></h2>
        
        <?php if(flash_has("error")):?>
        <div class="alert-error">
            <?php echo flash_show("error");?>
        </div>
        <?php endif;?>
        
        <div class="input-group grid-row">
            <label class="input-label">Usuario: </label><input class="input-field" type="text" name="usuario">
        </div>
        <div class="input-group grid-row">
            <label class="input-label">Nombre: </label><input class="input-field" type="text" name="nombre">
        </div>
        <div class="input-group grid-row">
            <label class="input-label">Apellido: </label><input class="input-field" type="text" name="apellido">
        </div>
        <div class="input-group grid-row">
            <label class="input-label">Email: </label><input class="input-field" type="text" name="email">
        </div>
        <br>
        <div class="input-group grid-row">
            <button class="btn-green" type="submit">Crear Usuario</button>
            <a class="btn-blue" href="/usuarios">Volver</a>
        </div>
    </form>
</article>
