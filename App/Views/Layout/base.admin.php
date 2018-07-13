<html lang="es">
    <head>
        <base href="/" />
        <meta charset="utf-8" />
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		
        <title><?php echo $web_title;?></title>
		
        <link href="images/favicon.ico" rel="shortcut icon" type="image/x-icon">
        
        <link rel="stylesheet" href="css/pirulo.reset.css?<?php echo rand();?>" />
        <link rel="stylesheet" href="css/pirulo.grid.css?<?php echo rand();?>" />
        <link rel="stylesheet" href="css/pirulo.elements.css?<?php echo rand();?>" />
        <link rel="stylesheet" href="css/pirulo.style.css?<?php echo rand();?>" />
        <link rel="stylesheet" href="css/pirulo.admin.css?<?php echo rand();?>" />
        <link rel="stylesheet" href="css/fontawesome-free-5.1.0-web/css/all.css?<?php echo rand();?>" />
    </head>
    <body>
        <div class="wrapper">
            <div class="header">
                <div class="brand">
                <?php echo $web_site;?>
                </div>
                <div class="welcome">
                Bienvenido, <?php echo $usuario;?><?php echo session_has("is_god") ? " (GOD MODE)" : "";?>
                | <a href="/logout" class="icon" title="Salir"><i class="fa fa-sign-out-alt"></i>Salir</a>
                </div>
            </div>
            <div class="base">
                <div class="nav">
                    <?php echo $web_menu;?>
                </div>
                <main class="main">
                    <div class="main-content" id="content">
                    <?php echo isset($web_content) ? $web_content : "";?>
                    </div>
                </main>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script type="text/javascript" src="js/Lux.js"></script>
        <script type="text/javascript" src="js/mvc.js"></script>
        <script type="text/javascript" src="js/base.js"></script>
    </body>
</html>
