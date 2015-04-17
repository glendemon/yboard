/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function setFavoriteAdv(id, t) {
    $.get(baseUrl+'/adverts/SetFavorites/id/'+id,function(data){     
        if(data=='true')
            $(t).find('i').attr('class','fa fa-bookmark');
        else
            $(t).find('i').attr('class','fa fa-bookmark-o');
    })
}

function loadFields(t){
    
	$('#Adverts_category_id').val($(t).val());

	$.get(baseUrl+"/cat_fields/"+$(t).val(), function(data){
                
		if(data.indexOf('fields_list')!==-1) 
			$("#bulletin_form").show();
		else
			$("#bulletin_form").hide();
			$(t).parent().find('div.ajax-div').html("<div>"+data+"<div class='ajax-div'></div></div>");
		});
    
}