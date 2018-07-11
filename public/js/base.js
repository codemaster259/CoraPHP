
Lux.ready(function(){
    
    Lux("nav a").on("click",function(e){
        
        /*
        Lux("#content").html("");
        e.preventDefault();
        Lux.req.ajax({
            url: Lux(this).attr("href"),
            json: false,
            success: function(response){
                Lux("#content").html(response);
            }
        });
        e.preventDefault();
        */
    });
    
    
    Lux('[class^="alert-"]').delay(2000, function(e){
        Lux(e).hide();
        /*
        setTimeout(function(){
            Lux(e).show();
        }, 3000);
        */
    });
   
    /*
    Lux('[class^="alert-"]').delay(2000, function(el){
        console.log("call delay");
        Lux('[class^="alert-"]').loop(50, function(e){
            
            console.log("start loop");
            e.style.opacity = 1;
            
        }, function(e){
            
            console.log("make loop");
            if(e.style.opacity > 0)
            {
                console.log("repeat loop");
                e.style.opacity = parseFloat(e.style.opacity) - 0.1;
                return false;
            }
            console.log("end loop");
            return true;
        });
    });
    */
});