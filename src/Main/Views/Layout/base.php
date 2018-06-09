<html>
    <head>
        <title><?php echo $web_title;?></title>
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
                <?php echo $web_msg;?> - Copy &copy; 2018
            </div>
        </div>
    </body>
</html>

