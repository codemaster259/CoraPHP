<article class="text-center">
    <h2><?php echo $page_title;?></h2>
    <br />
    <?php if(flash_has("error")):?>
        <div class="alert-red grid-4 automargin">
        <?php echo flash_show("error");?>
        </div>
    <?php endif;?>
    <?php if(flash_has("success")):?>
        <div class="alert-green grid-4 automargin">
        <?php echo flash_show("success");?>
        </div>
    <?php endif;?>
    <br />
    <div class="grid-row">
        <a href="/permisos/crear" class="btn-sky">Crear Permiso</a>
    </div>
    <br>
    <div class="grid-row scroll-x">
        <table class="table grid-half">
            <tr>
                <th class="">Nombre</th>
                <th class="">Area</th>
                <th class="">Accion</th>
                <th class="">Acciones</th>
            </tr>
            <?php foreach($permisos as $permiso):?>
            <tr>
                <td class="">
                    <?php echo $permiso->nombre;?>
                </td>
                <td class="">
                    <?php echo $permiso->area;?>
                </td>
                <td class="">
                    <?php echo $permiso->accion;?>
                </td>
                <td class="">
                    <a class="btn-sky" href="/permisos/editar/<?php echo $permiso->id;?>">Editar</a>
                    <a class="btn-red" href="/permisos/eliminar/<?php echo $permiso->id;?>">Eliminar</a>
                </td>
            </tr>
            <?php endforeach;?>
        </table>
    </div>
</article>