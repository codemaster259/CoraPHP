<article class="text-center">
    <h2><?php echo $page_title;?></h2>
    <br />
    <?php if(flash_has("error")):?>
        <div class="alert-error grid-4 automargin">
        <?php echo flash_show("error");?>
        </div>
    <?php endif;?>
    <?php if(flash_has("success")):?>
        <div class="alert-success grid-4 automargin">
        <?php echo flash_show("success");?>
        </div>
    <?php endif;?>
    <br />
    <div class="grid-row">
        <a href="/roles/crear" class="btn-sky">Crear Permiso</a>
    </div>
    <br>
    <div class="grid-row scroll-x">
        <table class="table grid-half">
            <tr>
                <th class="">Nombre</th>
                <th class="">Acciones</th>
            </tr>
            <?php foreach($roles as $rol):?>
            <tr>
                <td class="">
                    <?php echo $rol->nombre;?>
                </td>
                <td class="">
                    <a class="btn-sky" href="/roles/editar/<?php echo $rol->id;?>">Editar</a>
                    <a class="btn-red" href="/roles/eliminar/<?php echo $rol->id;?>">Eliminar</a>
                </td>
            </tr>
            <?php endforeach;?>
        </table>
    </div>
</article>