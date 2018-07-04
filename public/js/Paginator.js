function Paginator(data, page, limit){

    limit = limit || 4;

    var pages = Math.ceil(data.length / limit);

    var start = (page - 1) * limit;
    var end = start + limit;

    var slice = data.slice(start, end);
    
    this.getData = function(){
    	return slice;
    };

    this.getPages = function(){
        return pages;
    };

    this.getPage = function(){
        return page;
    };

    this.getPrevious = function(){
        if(page === 1){
            return page;
        }
        return page - 1;
    };

    this.getNext = function(){
        if(page === pages){
            return page;
        }
        return page + 1;
    };

    this.isFirst = function(){
        return page === 1;
    };

    this.isLast = function(){
        return page === pages;
    };
}