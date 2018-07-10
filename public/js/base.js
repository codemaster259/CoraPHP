
Lux.ready(function(){
    /*
    Lux(".nav-title").on("click",function(){
        if(Lux(".content").data("hidden"))
        {
            Lux(".content").show();
            Lux(".content").data("hidden", false);
        }else{
            Lux(".content").hide();
            Lux(".content").data("hidden", true);
        }

    });
    */
   
   Lux('[class^="alert-"]').delay(2000, function(e){
       e.hide();
   });
});