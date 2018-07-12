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
        <a href="/usuarios/crear" class="btn-sky">Crear Usuario</a>
    </div>
    <br>
    <div class="grid-row scroll-x">
        <table class="table grid-9">
            <tr>
                <th class="">Usuario</th>
                <th class="">Nombre</th>
                <th class="">Apellido</th>
                <th class="">Email</th>
                <th class="">Acciones</th>
            </tr>
            <?php foreach($users as $user):?>
            <tr>
                <td class="">
                    <?php echo $user->usuario;?>
                </td>
                <td class="">
                    <?php echo $user->nombre;?>
                </td>
                <td class="">
                    <?php echo $user->apellido;?>
                </td>
                <td class="">
                    <?php echo $user->email;?>
                </td>
                <td class="">
                    <a class="btn-blue" href="/usuarios/ver/<?php echo $user->id;?>">Ver</a>
                    <a class="btn-sky" href="/usuarios/editar/<?php echo $user->id;?>">Editar</a>
                    <a class="btn-red" href="/usuarios/eliminar/<?php echo $user->id;?>">Eliminar</a>
                </td>
            </tr>
            <?php endforeach;?>
        </table>
    </div>
</article>