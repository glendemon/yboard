/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(window).load(function(){   
	$('.sidebar-menu .menu-dropdown').click(function(){
		var el=$(this).parent().find('.submenu')[0];
		if($(el).css('display')==="none") {
			$(el).slideDown(200); //('Blind',{'easing':'linear'});
		}else{
			$(el).slideUp(200); //('Blind',{'easing':'linear'});
		}
	});
});