<article>
    <form method="POST" class="form grid-9">
        <h2><?php echo $page_title;?></h2>
        
        <?php if(flash_has("error")):?>
        <div class="alert-error">
            <?php echo flash_show("error");?>
        </div>
        <?php endif;?>
        
        <div class="input-group grid-row">
            <input type="hidden" name="id" value="<?php echo $user->id ;?>">
            <label class="input-label">Usuario: <strong><?php echo $user->usuario;?></strong></label>
        </div>
        <div class="input-group grid-row">
            <label class="input-label">Nombre: </label><input class="input-field" type="text" name="nombre" value="<?php echo $user->nombre;?>">
        </div>
        <div class="input-group grid-row">
            <label class="input-label">Apellido: </label><input class="input-field" type="text" name="apellido" value="<?php echo $user->apellido;?>">
        </div>
        <div class="input-group grid-row">
            <label class="input-label">Email: </label><input class="input-field" type="text" name="email" value="<?php echo $user->email;?>">
        </div>
        <div class="input-group grid-row">
            <label class="input-label">Reset Password (1234): <input type="checkbox" name="reset" value="1"></label>
        </div>
        <br>
        <div class="input-group grid-row">
            <input class="btn-green" type="submit" value="Guardar Usuario"/>
            <a class="btn-blue" href="/usuarios">Volver</a>
        </div>
    </form>
</article>
