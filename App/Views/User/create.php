<article>
    <form method="POST" class="form grid-9">
        <h2><?php echo $page_title;?></h2>
        <?php if(isset($error)):?>
        <div class="alert-error">
            <?php echo $error;?>
        </div>
        <?php endif;?>
        
        <?php if(isset($success)):?>
        <div class="alert-success">
            <?php echo $success;?>
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
        </div>
    </form>
</article>
