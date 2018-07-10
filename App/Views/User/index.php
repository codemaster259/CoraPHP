<article>
    <h2><?php echo $page_title;?></h2>
    <div class="grid-row">
        <a href="/usuarios/crear" class="btn-sky">Crear Usuario</a>
    </div>
    <br>
    <div class="grid-row scroll-x">
        <table class="table">
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