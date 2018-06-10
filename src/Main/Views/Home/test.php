<article>    
    <h2><?php echo $page_title;?></h2>
    <div>
        <?php echo $page_content;?>
    </div>
    <div>
        <?php
        if(!empty($_GET))
        {
            echo "<pre>". print_r($_GET, true)."</pre>";
        }
        ?>
    </div>
</article>
