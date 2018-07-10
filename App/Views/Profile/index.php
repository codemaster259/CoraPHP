<article>
    <form method="POST" class="form grid-9">
        <h2><?php echo $page_title;?></h2>
        
        <?php if(flash_has("error")):?>
        <div class="alert-error">
            <?php echo flash_show("error");?>
        </div>
        <?php endif;?>
        
        <?php if(flash_has("success")):?>
        <div class="alert-success">
            <?php echo flash_show("success");?>
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
        <br>
        <div class="input-group grid-row">
            <input class="btn-green" type="submit" value="Guardar Perfil" name="updateprofile"/>
        </div>
    </form>
    <form method="POST" class="form grid-9">
        <h2>Cambiar Password:</h2>
        
        <?php if(flash_has("error2")):?>
        <div class="alert-error">
            <?php echo flash_show("error2");?>
        </div>
        <?php endif;?>
        
        <?php if(flash_has("success2")):?>
        <div class="alert-success">
            <?php echo flash_show("success2");?>
        </div>
        <?php endif;?>
        
        <div class="grid-row">
            <div class="input-group grid-row">
                <label class="input-label">Password: </label><input class="input-field" type="password" name="password" />
            </div>
            <div class="input-group grid-row">
                <label class="input-label">Repite Password: </label><input class="input-field" type="password" name="password2" />
            </div>
            <br>
            <div class="input-group grid-row">
                <input class="btn-green" type="submit" value="Cambiar Password" name="changepass"/>
            </div>
        </div>
    </form>
</article>