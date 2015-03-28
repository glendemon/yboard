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