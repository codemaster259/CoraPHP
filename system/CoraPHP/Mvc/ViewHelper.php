<?php

namespace CoraPHP\Mvc;

class ViewHelper{
    
    public function link($href, $text = "", $options = array())
    {
        $link = "<a href=\"{$href}\"";
        
        if(!empty($options))
        {
            if(isset($options['class']))
            {
                $link .= " class=\"{$options['class']}\"";
            }
            
            if(isset($options['target']))
            {
                $link .= " target=\"{$options['target']}\"";
            }
            
            if(isset($options['onlick']))
            {
                $link .= " onclick=\"{$options['target']}\"";
            }
        }
        
        if(!$text)
        {
            $text = $href;
        }
        
        $link .= ">{$text}</a>";
        
        return $link;
    }
}

