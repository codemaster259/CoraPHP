<article class="text-center">
    <h2><?php echo $page_title;?></h2>
     <div class="grid-row scroll-x">
        <table class="table">
            <tr><td>User: </td><td><?php echo $user->usuario;?></td></tr>
            <tr><td>Nombre: </td><td><?php echo $user->nombre;?></td></tr>
            <tr><td>Apellido: </td><td><?php echo $user->apellido;?></td></tr>
            <tr><td>Email: </td><td><?php echo $user->email;?></td></tr>
        </table>
    </div>
    <br>
    <div><a class="btn-blue" href="/usuarios">Volver</a></div>
</article>