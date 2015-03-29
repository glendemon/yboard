jQuery.fn.initSort = function(options){
    
    /*** required options ***/
    var defaults = {
        sortUrl: ''
    };
    var o  = $.extend(defaults,options);
    
    var $rows = jQuery('.items tbody tr[class]')
    
    var rowsCount = $rows.size();
    
    if (!rowsCount) return false;
    
    $rows.find('.drag').css('cursor','move');
    
    jQuery('.items tbody').sortable({ 
        helper: 'clone', 
        axis: 'y',
        cursor: 'move',
        opacity:0.6,
        items:'tr[class]',
        handle:'.drag',
        containment: 'parent',
        update: function(event, ui) {
            var itemId = ui.item.find(':hidden[name*=sort]').val();
            var nextId = ui.item.next().find(':hidden[name*=sort]').val();
            var prevId = ui.item.prev().find(':hidden[name*=sort]').val();
            
            jQuery('.items tbody tr')
                .removeAttr('class')
                .filter(':odd').addClass('even').end()
                .filter(':even').addClass('odd');
            jQuery.post(o.sortUrl,{prev:prevId,item:itemId,next:nextId},function(data){
                // sort OK
            });
        }
    });
}


jQuery.fn.setUrl = function(options){
    
    /*** required options ***/
    var defaults = {
        parentUrl: '',
        translitUrl: ''
    };
    var o  = $.extend(defaults,options);
    
    var parent_url;
    var $url = $('input[name*=url]');
    $('select[name*=parent_id]').change(function(){
        var parent_id = this.value;
        $.post(o.parentUrl,{parent_id:parent_id},function(data){
            parent_url = data;
        });
    }).trigger('change');

    $('input[name*=name]').keyup(function(){
        var name = this.value;
        $.post(o.translitUrl,{name:name},function(data){
            $('#translit').html('Sample url: <span id=set_url style="font-weight:bold;"><i>'+parent_url+data+'</i></span>&nbsp;&nbsp;<a href="#" id="set">set</a>');
            $('#set').click(function(){
                $url.val(parent_url+data);
                return false;
            });
        });
    });   
    
}