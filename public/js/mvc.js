var MVC = {};

//controller base
MVC.Controller = function(v, m){
    this.view = v;
    this.model = m;
    return this;
};
MVC.Controller.prototype.addMethod = function(name, callback){
    this[name] = callback;
};


//model base
MVC.Model = function(){
    return this;
};
MVC.Model.prototype.addMethod = function(name, callback){
    this[name] = callback;
};


//view base
MVC.View = function(){    
    return this;
};
MVC.View.prototype.addView = function(name, callback){
    this[name] = callback;
};

//create view
var v = new MVC.View();
v.addView("result",Lux("#mvc-result"));
v.addView("click", Lux("#mvc-click"));

//create model
var m = new MVC.Model();

m.addMethod("loadName", function(){
    var val = Lux("#mvc-name").val();
    Lux("#mvc-name").val("");
    return val;
});

//create controller
var test = new MVC.Controller(v, m);

test.addMethod("test", function(){
    
    this.view["click"].on("click", function(){
        test.view["result"].html(test.model.loadName());
    });
});

//call controller action
test.test();