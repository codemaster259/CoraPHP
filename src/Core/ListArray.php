<?php
namespace Core;

class ListArray extends ArrayObject{
    
    
    public function filter(/* callable */ $callback = null)
    {
        if(is_callable($callback))
        {  
            $this->exchangeArray(array_filter($this->getArrayCopy(), $callback));
        }
        return $this;
    }
    
    public function showme()
    {
        echo "<pre>";
        print_r($this);
        echo "</pre>";
    }
}