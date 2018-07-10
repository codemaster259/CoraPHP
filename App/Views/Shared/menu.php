<header class="menu nav-menu grid-row">
    <nav class='nav-menu'>
        <div class='container'>			
            <a class="nav-brand" href="/"><?php echo $web_site;?></a>
            <label class="nav-label" for="toggle" class="button">
                <span></span>
            </label>
            <input class="nav-chbx" type="checkbox" id="toggle">
            <ul class="nav-ul">
                <?php if($login):?>
                <li><a href="/usuarios">Usuarios</a></li>
                <li><a href="/perfil">Perfil</a></li>
                <li><a href="/logout">Logout</a></li>
                <?php else:?>
                <li><a href="/login">Login</a></li>
                <?php endif;?>
            </ul>
        </div>
    </nav>
</header>
