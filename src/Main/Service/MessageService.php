<?php

namespace Main\Service;

class MessageService{

    public function sayRandom()
    {
        $msgs = array("Mortal Kombat!","Here be dragons!","LOL", "Lorem ipsum dolor sit amet...","Hello World");
        
        $key = array_rand($msgs);
        
        return $msgs[$key];
    }
	
	public function lorem()
	{
		$lorem = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
			Sed nec est ac nulla semper varius at ac magna. Sed odio purus, 
			condimentum et est vitae, ultricies dictum lectus. 
			Integer bibendum nec libero sed volutpat. Cras magna risus, 
			mollis non felis non, lacinia scelerisque tellus. Integer 
			fermentum magna et ex malesuada hendrerit. Sed sit amet orci 
			ultricies, pellentesque diam non, porta odio. Sed sed ex vel mi 
			maximus euismod. Interdum et malesuada fames ac ante ipsum primis 
			in faucibus. Donec suscipit tincidunt arcu, non molestie risus ultrices non. 
			Proin vitae odio pellentesque, consectetur felis et, ultrices metus. Etiam sit 
			amet felis nec mauris volutpat feugiat sit amet vel justo. Praesent rhoncus metus ultricies luctus elementum.";
		
		return $lorem;
	}
}