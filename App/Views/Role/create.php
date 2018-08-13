<article class="text-center">
    <form method="POST" class="form grid-half">
        <h2><?php echo $page_title;?></h2>
        
        <?php if(flash_has("error")):?>
        <div class="alert-red">
            <?php echo flash_show("error");?>
        </div>
        <?php endif;?>

        <div class="input-group grid-row">
            <label class="input-label">Nombre: </label><input class="input-field" type="text" name="nombre">
        </div>
        <div class="input-group grid-row">
            <label class="input-label">Elegir Permisos: </label>
            <div class="input-group grid-row">
                <?php foreach($permisos as $permiso):?>
                <div class="block"><?php echo $permiso->nombre;?> <input type="checkbox" name="permisos[<?php echo $permiso->id;?>]"></div>
                <?php endforeach;?>
            </div>
        </div>
        <br>
        <div class="input-group grid-row">
            <button class="btn-green" type="submit">Crear</button>
            <a class="btn-blue" href="/roles">Volver</a>
        </div>
    </form>
</article>
