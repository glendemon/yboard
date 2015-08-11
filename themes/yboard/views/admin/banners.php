<?php
/*
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>


<style>
    .button a{
        display:block;
    }
    .button{
        width:100px;
        float:right;
    }
    textarea{
        height: 86px;
        width: 491px;
        margin:0px;
    }
    .one_banner{
        width:600px;
        margin: 10px 0px 10px;
    }
    .banner_viewer{
        display:none;
        background:#E67474;
        min-height:20px;
        margin:5px;
    }
    iframe{
        width:100%;
        height:auto;
    }

    #ads_code_redactor, input[type="radio"]{
        position:static;
        opacity:1;

    }

    .add_code_form input[type='text']{
        width:100px;
    }
    .add_code_form{
        margin:10px 10px 30px;
        padding:10px;
        border:1px solid #ccc;
    }

    .code_atributes{
        width:700px; text-height:20px; padding:4px;
    }
    .code_atributes input[type="text"]{
        margin:0px;
        width:50px;
    }

    .add_form{
       border:1px solid #ccc;
       padding:5px;
    }
    
    .block_div{
        margin:5px 0px;
        border:1px solid #ccc; 
        padding: 15px;
    }

</style>

<script>
    function show_banner(b_name, b_id) {
        $(".banner_viewer").html("");
        $(".banner_viewer").hide('fast');
        $('#banner_viewer_' + b_name).show('fast');
        $('#banner_viewer_' + b_name).html("<iframe width='100%' src='<?= Yii::app()->createUrl('/admin/banners/show') ?>?b_name=" + b_name + "&b_id=" + b_id + "'></iframe>");
    }

    function edit_banner(bl_name, b_id) {

        $.get("<?= Yii::app()->createUrl('/admin/banners/edit') ?>?b_name=" + bl_name + "&b_id=" + b_id,
                function (data) {

                    $('#banner_form_' + bl_name).html(data);
                    $('#banner_form_' + bl_name + ' form').show('slow');

                });

    }
    
    function enable_banner(bl_name, ads_id) {
        var cf = confirm("Отключить/включить блок");
        console.log(cf);
        if (cf) {
            window.location = '<?= Yii::app()->createUrl('admin/banners') ?>?enable_name=' + bl_name + '&enable_id=' + ads_id;
        }
    }


    function create_block() {
        var bl_name = prompt('Укажите id блока');
        if (bl_name != null) {
            window.location = '<?= Yii::app()->createUrl('admin/banners') ?>?create_block=yes&new_name=' + bl_name;
        }
    }

    function delete_ads(bl_name, ads_id) {
        var cf = confirm("Удалить этот рекламный код");
        console.log(cf);
        if (cf) {
            window.location = '<?= Yii::app()->createUrl('admin/banners') ?>?delete_name=' + bl_name + '&delete_id=' + ads_id;
        }
    }
    
    function delete_block(bl_name) {
        var cf = confirm("Удалить этот рекламный блок");
        if (cf) {
            window.location = '<?= Yii::app()->createUrl('admin/banners') ?>?delete_block=' + bl_name;
        }
    }

    function insert_ads(bl_name) {

        $('.add_code_form form').clone().appendTo('#banner_form_' + bl_name);
        $('#banner_form_' + bl_name + ' .block_name').val(bl_name);       
        $('#banner_form_' + bl_name + ' form').show('slow');
		$('#banner_form_' + bl_name + ' form input').last().focus();
    }

    var atr_i = 0;

    function del_attr(t) {
        $(t).parent().remove();
    }

    function add_test_atribute(t) {
        $(t).parent().parent().find(".code_atributes").append(
                " <div> Get параметр : <input type='text' name='conditions[" + atr_i + "][parameter]' />" +
                " <input type='radio' name='conditions[" + atr_i + "][compare]' value='1' /> равен  " +
                " <input type='radio' name='conditions[" + atr_i + "][compare]' value='0' /> не равен " +
                " со значением <input type='text' name='conditions[" + atr_i + "][value]'  /> <a href='javascript:void(0)' onclick='del_attr(this)'>удл.</a></div>");
        atr_i++;
    }

    function hide_form(t) {
        $(t).parent().parent().html('');
    }

    function add_exist_atribute(t) {
        $(t).parent().parent().find(".code_atributes").append(
                " <div> Get параметр : <input type='text' name='conditions[" + atr_i + "][parameter]'  />" +
                " <input type='radio' name='conditions[" + atr_i + "][exist]' value='1' /> существует  " +
                " <input type='radio' name='conditions[" + atr_i + "][exist]' value='0' /> не существует  <a href='javascript:void(0)' onclick='del_attr(this)'>удл.</a></div>");
        atr_i++;
    }

    function add_test_link(t) {

        $(t).parent().parent().find(".code_atributes").append(
                " <div> URL : <input type='text' name='conditions[" + atr_i + "][url]'  />" +
                " <input type='radio' name='conditions[" + atr_i + "][compare]' value='1' /> равен  " +
                " <input type='radio' name='conditions[" + atr_i + "][compare]' value='0' /> не равен " +
                "  <a href='javascript:void(0)' onclick='del_attr(this)'>удл.</a></div>");
    }

</script>
<div align='center' class='add_code_form'>
    <a href='<?= Yii::app()->createUrl("/admin/default/help") ?>#banners'> Инструкция </a>
    <?= $this->formBanner() ?>

</div>

<a href='javascript:create_block()' style='margin-bottom:40px; display:block; '> + Создать новый рекламный блок </a>

<?

if (sizeof($this->banners) > 0)
    foreach ($this->banners as $b_name => $banners) {
        echo "<div align='left' class='block_div' >
		<h3> Рекламный блок \"" . $b_name . "\"</h3>";

        if (sizeof($banners) > 0) {
            foreach ($banners as $n => $v) {
                echo "<div class='one_banner' >";
                if (is_array($v['conditions'])) {
                    echo "<div style='font-size:12px;'> Условие вывода :  <i>";
                    $cond_mess = "";
                    foreach ($v['conditions'] as $cond) {
                        if ($cond_mess !== "")
                            $cond_mess.=" and ";

                        if (isset($cond['parameter'])) {
                            if (isset($cond['compare'])) {
                                $cond_mess.="( \$_GET[" . $cond['parameter'] . "] "
                                        . ($cond['compare'] ? " = " : " != ") . " \"" . $cond['value'] . "\" )";
                            }
                            if (isset($cond['exist'])) {
                                $cond_mess.="( \$_GET[" . $cond['parameter'] . "] "
                                        . ($cond['exist'] ? " if exist " : " if not exist ") . "  )";
                            }
                        }

                        if (isset($cond['url'])) {
                            if (isset($cond['compare'])) {
                                $cond_mess.=" ( request_URI " . ($cond['compare'] ? " = " : " != ") . "   " . $cond['url'] . " ) ";
                            }
                        }
                    }
                    echo $cond_mess . "</i></div>";
                }
                echo "<h6 style='padding-left:20px'> ".$v['title']." </h6>"
                . "<textarea name='{$b_name}[$n]' id='code_{$b_name}_$n' cols='70'>" . $v['code'] . "</textarea>\n"
                . "<div class='button'>"
                . "<a href='javascript:show_banner(\"$b_name\",\"$n\")'> Показать </a>"
                . "<a href='javascript:edit_banner(\"$b_name\",\"$n\")'> Редактировать </a>\n"
                . "<a href='javascript:enable_banner(\"$b_name\",\"$n\")'> ".($v['enable']==="false"?"Включить":"Отключить")." </a>\n"
                . "<a href='javascript:delete_ads(\"$b_name\",$n)' > Удалить </a>\n"
                . "</div></div>";
            }
        } else {
            echo "<a href='javascript:delete_block(\"$b_name\")' style='color:#a00'> Удалить этот блок</a><br/>	";
        }
        
        echo "<a href='javascript:insert_ads(\"$b_name\")' > Добавить код </a>";
        echo "<div id='banner_form_$b_name' class='add_form' ></div>";
        echo "<div id='banner_viewer_$b_name' class='banner_viewer'></div>";
        echo "</div>";
    }