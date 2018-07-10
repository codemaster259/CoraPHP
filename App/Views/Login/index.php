<article >
    <form method="POST" class="form grid-half">
        <h2>Iniciar Sesion</h2>
        <?php if(flash_has("error")):?>
        <div class="alert-error">
            <?php echo flash_show("error");?>
        </div>
        <?php endif;?>
        <div class="input-group grid-row">
            <label class="input-label">Usuario: </label><input class="input-field" type="text" name="usuario" />
        </div>
        <div class="input-group grid-row">
            <label class="input-label">Password: </label><input class="input-field" type="password" name="password" />
        </div>
        <br>
        <div class="input-group grid-row">    
            <button class="btn-blue" type="submit">Entrar</button>  
        </div>
    </form>
</article>