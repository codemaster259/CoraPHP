<article>
    <form method="POST" class="form grid-half">
        <h2><?php echo $page_title;?></h2>
        
        <?php if(flash_has("error")):?>
        <div class="alert-red grid-4 automargin">
            <?php echo flash_show("error");?>
        </div>
        <?php endif;?>
        
        <div class="input-group grid-row">
            <input type="hidden" name="id" value="<?php echo $rol->id ;?>">
        </div>
        <div class="input-group grid-row">
            <label class="input-label">Nombre: </label><input class="input-field" type="text" name="nombre" value="<?php echo $rol->nombre;?>">
        </div>
        <div class="input-group grid-row">
            <label class="input-label">Elegir Permisos: </label>
            <div class="input-group grid-row" style="height:250px;overflow-y:auto;">
                <?php foreach($permisos as $permiso):?>
                <div class="miniblock"><?php echo $permiso->nombre;?> <input type="checkbox" name="permisos[<?php echo $permiso->id;?>]" <?php echo decide(isset($permiso->active), "checked", "");?>></div>
                <?php endforeach;?>
            </div>
        </div>
        <br>
        <div class="input-group grid-row">
            <button class="btn-green" type="submit">Guardar</button>
            <a class="btn-blue" href="/roles">Volver</a>
        </div>
    </form>
</article>