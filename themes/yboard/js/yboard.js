/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function setFavoriteAdv(id, t) {
    $.get(baseUrl + '/adverts/SetFavorites/id/' + id, function (data) {
        if (data == 'true')
            $(t).find('i').attr('class', 'fa fa-bookmark');
        else
            $(t).find('i').attr('class', 'fa fa-bookmark-o');
    })
}

function loadFields(t) {

    $('#Adverts_category_id').val($(t).val());

    $.get(baseUrl + "/cat_fields/" + $(t).val(), function (data) {

        if (data.indexOf('fields_list') !== -1)
            $("#bulletin_form").show();
        else
            $("#bulletin_form").hide();
        $(t).parent().find('div.ajax-div').html("<div>" + data + "<div class='ajax-div'></div></div>");
    });

}


function show_converter(){
    if($('.price_converter').css('display')=='none'){
        $('.price_converter').show('slow');
    } else {
        $('.price_converter').hide('slow');
    }
}


/*
 * 
 * Settings 
 * 
 */

function addOption(t, name) {

    var optList = $(t.parentNode).find('div');
    var opt = parseInt($(optList[optList.length - 1]).find('input').attr('atr_id'));

    $("<div><input type='text' atr_id='" + (opt + 1) + "' name='config[" + name + "][" + (opt + 1) + "]'  value='' />"
    + " <a class='icon-remove' href='javascript:void(0)' onclick='removeOption(this)' ></a></div>").insertBefore(t);

}
function removeOption(t) {

    $(t.parentNode).find('input').attr('value', '');
    $(t.parentNode).css('display', 'none');

}


function open_search(){
    if( $(".advanced_search").css('display') == 'none' )
        $(".advanced_search").show();
    else
        $(".advanced_search").hide();
}