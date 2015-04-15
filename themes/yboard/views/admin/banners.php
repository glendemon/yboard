<?php
/*
 * To change this license header, choose License Headers in Project Properties.
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
</style>

<script>
    function show_banner(b_name, b_id) {
        $(".banner_viewer").html("");
        $(".banner_viewer").hide('fast');
        $('#banner_viewer_' + b_name).show('fast');
        /*
        $.get("<?= Yii::app()->createUrl('admin/banners/show') ?>?b_name=" + b_name + "&b_id=" + b_id, 
        function (data){
            $('#banner_viewer_' + b_name).html(data);
        });
        /**/
        $('#banner_viewer_' + b_name).html("<iframe width='100%' src='<?= Yii::app()->createUrl('/admin/banners/show') ?>?b_name=" + b_name + "&b_id=" + b_id + "'></iframe>");
    }

    function create_block() {
        var bl_name = prompt('Укажите id блока');
        if(bl_name!=null) {
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
        //var ads_code=prompt('Вставьте код блока');
        fr = document.forms.insert_ads_form;
        //fr.ads_code.value=ads_code;
        $('#ads_code_redactor').show('fast');
        $('#ads_code_redactor textarea').focus();
        fr.block_name.value = bl_name;
        //fr.submit();
        //windows.location='?mod=banners&insert_ads=yes&ads_code='+ads_code+"&block_name="+;
    }

    var atr_i = 0;

    function add_atribute() {
        $("#code_atributes").append(
            "Get параметр : <input type='text' name='conditions[" + atr_i + "][parameter]' size='10' />" +
            " <input type='radio' name='conditions[" + atr_i + "][compare]' value='1' /> равен  " +
            " <input type='radio' name='conditions[" + atr_i + "][compare]' value='0' /> не равен " +
            " со значением <input type='text' name='conditions[" + atr_i + "][value]' size='10' /> <br/>");
        atr_i++;
    }

</script>
<div align='center' class='add_code_form'>
    
<form method='post' name='insert_ads_form' action='<?= Yii::app()->createUrl('admin/banners') ?>' 
      style='display:none' id='ads_code_redactor' align='center'>
    <h4>Добавление кода для блока</h4>
    <textarea  name='ads_code' style='width:625px'></textarea>
    <input type='hidden' name='block_name' />
    <input type='hidden' name='insert_ads' value='yes'/> <br/>
    <div id='code_atributes'></div>
    <a href='javascript:void(0)' onclick='add_atribute()'> Добавить условие для вывода</a> <br/>
    <input type='submit' value='Добавить код' />
</form>
    
</div>

<a href='javascript:create_block()' style='margin-bottom:40px; display:block; '> Создать новый рекламный блок </a>

<?
//var_dump($this->banners);

if (sizeof($this->banners) > 0)
    foreach ($this->banners as $b_name => $banners) {
        echo "<div align='left' style='border:1px solid #ccc; padding: 15px; '>
		<h3> Рекламный блок \"" . $b_name . "\"</h3>";

        if (sizeof($banners) > 0) {
            foreach ($banners as $n => $v) {
                echo "<div class='one_banner' >";
                if(is_array($v['conditions'])) {
                    echo "<div style='font-size:12px;'> Условие вывода :  <i>";
                    $cond_mess="";
                foreach($v['conditions'] as $cond){
                    if($cond_mess!=="")
                        $cond_mess.=" and ";
                    $cond_mess.="( \$_GET[".$cond['parameter']."] "
                        .($cond['compare']?" = ":" != ")." \"".$cond['value']."\" )";
                }
                echo $cond_mess."</i></div>";
                }
                echo "<textarea name='{$b_name}[$n]' id='code_{$b_name}_$n' cols='70'>".$v['code']."</textarea>\n"
                . "<div class='button'><a href='javascript:show_banner(\"$b_name\",\"$n\")'> Показать </a>\n"
                . "<a href='javascript:delete_ads(\"$b_name\",$n)' > Удалить </a>\n"
                . "</div></div>";
            }
        } else {
            echo "<a href='javascript:delete_block(\"$b_name\")' style='color:#a00'> Удалить этот блок</a><br/>	";
        }
        echo "<div id='banner_viewer_$b_name' class='banner_viewer'></div>";
        echo "<a href='javascript:insert_ads(\"$b_name\")'> Добавить новый код в этот блок</a>";
        echo "</div>";
    }