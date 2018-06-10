<html>
    <head>
        <base href="<?php echo $web_http;?>" />
        <title><?php echo $web_title;?></title>
        <link href='images/favicon.ico' rel='shortcut icon' type='image/x-icon'>
        <link rel="stylesheet" href="css/style.css?<?php echo rand();?>" />
    </head>
    <body>
        <div id='main'>
            <div id='header' class='row'>
                <?php echo $web_menu;?>
            </div>
            <div id='content' class='row'>
                <div class='col-75'>
                    <?php echo $web_content;?>
                </div>
                <div id='sidebar' class='col-25'>
                    <?php echo $web_sidebar;?>
                </div>
            </div>
            <div id='footer' class='row'>
                <?php echo $web_msg;?> - CoraPHP v3 &copy; 2018
            </div>
        </div>
    </body>
</html>