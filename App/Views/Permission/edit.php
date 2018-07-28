<article>
    <form method="POST" class="form grid-half">
        <h2><?php echo $page_title;?></h2>
        
        <?php if(flash_has("error")):?>
        <div class="alert-error grid-4 automargin">
            <?php echo flash_show("error");?>
        </div>
        <?php endif;?>
        
        <div class="input-group grid-row">
            <input type="hidden" name="id" value="<?php echo $permiso->id ;?>">
        </div>
        <div class="input-group grid-row">
            <label class="input-label">Nombre: </label><input class="input-field" type="text" name="nombre" value="<?php echo $permiso->nombre;?>">
        </div>
        <div class="input-group grid-row">
            <label class="input-label">Area: </label><input class="input-field" type="text" name="area" value="<?php echo $permiso->area;?>">
        </div>
        <div class="input-group grid-row">
            <label class="input-label">Accion: </label><input class="input-field" type="text" name="accion" value="<?php echo $permiso->accion;?>">
        </div>
        <br>
        <div class="input-group grid-row">
            <button class="btn-green" type="submit">Guardar</button>
            <a class="btn-blue" href="/permisos">Volver</a>
        </div>
    </form>
</article>
