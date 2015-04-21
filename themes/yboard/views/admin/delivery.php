<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>

<?php $this->widget('application.extensions.email.debug'); ?>
<?=$this->error?>
<?=$messages?>
<form method='post' name='delivery_form'>
        <? if($_SERVER['REQUEST_TYPE']==="POST") { ?>
        Страница <input type='text' value='<?=($_POST['users_page']+1)?>' name='users_page' />
        <? } ?>
	<label for='email_theme'>Тема письма</label> <br/>
	<input type='text' name='email_theme' value="<?=$_POST['email_theme']?>" style='width:600px' /> <br/>
	<label for='email_body'>Содержание письма</label> <br/>
	<textarea name='email_body' style='width:600px; height:375px;'><?=$_POST['email_body']?></textarea> <br/><br/>
        <input type='checkbox' name='delivery_autorun'  value='<?=($_POST['delivery_autorun']?"on":"")?>' />
        <input type='submit' class='btn' value='Разослать всем пользователям'  /> 
</form>

<? if($_POST['delivery_autorun']) { ?>
<script> 
    setTimeout('start_delivery',10000);
    function start_delivery(){
        document.forms.delivery_form.submit();
    }
</script>
    
<? } ?>