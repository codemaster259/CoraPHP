Array.prototype.contains = function(obj) {
    return this.indexOf(obj) > -1;
};

var FAKEDB = {};

FAKEDB.Table = function(name, fields){
    this.name = name;
    
    this.rows = [];
    
    this.fields = fields;
    
    var nextID = 1;
    
    this.getNextID = function()
    {
      var n = nextID;
      return n;
    };
    
    this.incrementID = function()
    {
        nextID++;
    };
    
    this.matchFields = function(row)
    {
        for(var prop in row)
        {
            if(row.hasOwnProperty(prop))
            {
                if(!this.fields.contains(prop))
                {
                    return false;
                }
            }
        }
        
        return true;
    }
};

FAKEDB.DB = function(name){
    
    this.name = name;
    
    this.tables = {};
    
    this.cerateTable = function(name, fields){
        this.tables[name] = new FAKEDB.Table(name, fields);
    };
    
    function getRow(row){
        return Object.assign({}, row);
    }

    this.getRowById = function(table, id)
    {
        var tablerows = this.tables[table].rows;
        
        for(var row in tablerows)
        {
            if(tablerows[row].id == id)
            {
                return getRow(tablerows[row]);
            }
        }
        
        return null;
    };
    
    this.getRowsByField = function(table, field, value)
    {
        var res = [];
        var tablerows = this.tables[table].rows;
        
        for(var row in tablerows)
        {
            if(tablerows[row][field] && tablerows[row][field] == value)
            {
                res.push(getRow(tablerows[row]));
            }
        }
        
        return res;
    };
    
    this.insert = function(table, row){

        if(this.tables[table].matchFields(row))
        {
            row.id = this.tables[table].getNextID();
            this.tables[table].rows.push(getRow(row));
            this.tables[table].incrementID();
        }

    };
    
    this.update = function(table, data, id)
    {
        var tablerows = this.tables[table].rows;
        
        for(var row in tablerows)
        {
            if(tablerows[row].id == id)
            {
                tablerows[row] = data;
            }
        }
    };
};

var db = new FAKEDB.DB("mydb");

db.cerateTable("users",["name","email"]);

db.insert("users", {name:"pirulo", email:"pirulo@mail.com"});
db.insert("users", {name:"jesus", email:"jesus.com"});
db.insert("users", {name:"loro", email:"loro.com"});
db.insert("users", {name:"jebus", email:"loro.com"});

user = db.getRowById("users", 1);

console.log(user);

users = db.getRowsByField("users", "email", "loro.com");

console.log(users);

console.log(db.tables["users"].rows);

user.name="pirulonnnn";
db.update("users", user, user.id);

console.clear();