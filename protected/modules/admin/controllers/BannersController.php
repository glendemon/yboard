<?php

class BannersController extends BackendController {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '/admin-template';
    public $title = "Рекламные блоки";

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionShow() {
        ob_get_clean();
        ?><html><head></head><body>
        <?= $this->banners[$_GET['b_name']][$_GET['b_id']]['code'] ?>
            </body></html><?
    }
    
    public function actionEdit() {

        // echo json_encode( $this->banners[$_GET['b_name']][$_GET['b_id']]);
        
        echo $this->formBanner($this->banners[$_GET['b_name']][$_GET['b_id']], $_GET['b_name'], $_GET['b_id']);

    }
    
    public function formBanner($bn=false, $b_name=false, $b_id= 0){
                
        ?>
        <form method='post' style='display:none' name='insert_ads_form' action='<?= Yii::app()->createUrl('admin/banners') ?>' 
               align='center'>
            <h4><?=$bn?"Редактировать код":"Добавление кода для блока"?> <a href='javascript:void(0)' onclick='hide_form(this)'> x </a></h4>
              <input type='text' name='title_code' value='<?=$bn['title']?>' style='width:491px;' placeholder="Название, необязательно" /> <br/>
              <textarea  name='ads_code' style='width:491px'  placeholder="Основной код"><?=$bn['code']?></textarea> <br/>
              <textarea  name='ads_code_footer' style='width:491px; height:40px;' placeholder="Добавочный код, выводится в конце страницы"><?=$bn['code_footer']?></textarea>
              <input type='hidden' name='block_name' class='block_name' value='<?=$b_name?>' />
              <input type='hidden' name='action_name' value='<?=($bn?"edit":"insert")?>'/>
              <input type='hidden' name='block_id' value='<?=$b_id?>' />
              <div class='code_atributes' align='left'><?
              
             
              
              if(is_array($bn['conditions']))
              foreach($bn['conditions'] as $c_n => $cond) {
                  
                  if($cond['parameter'] and isset($cond['compare']) ) { ?>

            <div> Get параметр : <input type='text' name='conditions[<?=$c_n?>][parameter]'  value='<?=$cond['parameter']?>' />
            <input type='radio' name='conditions[<?=$c_n?>][compare]' value='1' <?=($cond['compare']?"checked='checked'":"")?> /> равен  
            <input type='radio' name='conditions[<?=$c_n?>][compare]' value='0' <?=($cond['compare']?"":"checked='checked'")?>/> не равен 
            со значением <input type='text' name='conditions[<?=$c_n?>][value]'  value='<?=$cond['value']?>' /> <a href='javascript:void(0)' onclick='del_attr(this)'>удл.</a></div>
                  <? } 
                  if($cond['parameter'] and isset($cond['exist']) ) { ?>
                    <div> Get параметр : <input type='text' name='conditions[<?=$c_n?>][parameter]' value='<?=$cond['parameter']?>'  />
                    <input type='radio' name='conditions[<?=$c_n?>][exist]' value='1' <?=($cond['exist']?"checked='checked'":"")?>  /> существует  
                    <input type='radio' name='conditions[<?=$c_n?>][exist]' value='0' <?=($cond['exist']?"":"checked='checked'")?>  /> не существует  <a href='javascript:void(0)' onclick='del_attr(this)'>удл.</a></div>
                  
                  
                  
                  <? }
                  
                  if($cond['url'] ) { ?>
                  
                    <div> URL : <input type='text' name='conditions[<?=$c_n?>][url]'  value='<?=$cond['url']?>' />
                        <input type='radio' name='conditions[<?=$c_n?>][compare]' value='1' <?=($cond['compare']?"checked='checked'":"")?> /> равен   
                        <input type='radio' name='conditions[<?=$c_n?>][compare]' value='0' <?=($cond['compare']?"":"checked='checked'")?> /> не равен   <a href='javascript:void(0)' onclick='del_attr(this)'>удл.</a></div>");
                  
                  
                  <? }

    }

              ?></div>
                  <div  style='width:600px' align='left'>
                          <a href='javascript:void(0)' onclick='add_test_atribute(this)'> + сравнение с Get параметром</a> <br/>
                          <a href='javascript:void(0)' onclick='add_exist_atribute(this)'> + существование Get параметра </a> <br/>
                          <a href='javascript:void(0)' onclick='add_test_link(this)'> + проверка URL </a> <br/>
                  </div>
              <input type='submit' value='<?=$bn?"Редактировать код":"Добавить код"?>' />
          </form>    
            <?
        
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {

        $banners_file = Yii::getPathOfAlias('application.config.banners') . ".php";
        //include $banners_file;

        $save_banners = false;

        if (isset($_GET['create_block']) and isset($_GET['new_name'])) {
            if (preg_match("#[-_a-z]{4,}#is", $_GET['new_name'])) {
                $this->banners[$_GET['new_name']] = Array();
                $save_banners = true;
            } else {
                $ERROR['block_name'] = "Неправельное название для блока";
            }
        }

        if ($_POST['action_name'] === "insert" or $_POST['action_name'] === "edit") {
                        
            $new_adv_code=array();
            $new_adv_code['code']=$_POST['ads_code'];
            $new_adv_code['code_footer']=$_POST['ads_code_footer'];
            $new_adv_code['title']=$_POST['title_code'];
            $new_adv_code['conditions']=$_POST['conditions'];
            
            if($_POST['action_name'] === "edit") {
                $this->banners[$_POST['block_name']][$_POST['block_id']] = $new_adv_code;
            } else {
                $this->banners[$_POST['block_name']][] = $new_adv_code;
            }
            
            $save_banners = true;
        }

        if (isset($_GET['delete_block'])) {
            unset($this->banners[$_GET['delete_block']]);
            $save_banners = true;
        }

        if (isset($_GET['delete_name']) and isset($_GET['delete_id'])) {
            unset($this->banners[$_GET['delete_name']][$_GET['delete_id']]);
            $save_banners = true;
        }
        
        if (isset($_GET['enable_name']) and isset($_GET['enable_id'])) {
            if($this->banners[$_GET['enable_name']][$_GET['enable_id']]['enable']==="false") {
                $this->banners[$_GET['enable_name']][$_GET['enable_id']]['enable']="true";
            } else {
                $this->banners[$_GET['enable_name']][$_GET['enable_id']]['enable']="false";
            }
            $save_banners = true;
        }

        if ($save_banners) {
            file_put_contents($banners_file, "<? return " . var_export($this->banners, true) . "; ");
            $this->redirect(array('/admin/banners'));
        }




        $this->render('/banners');
    }

}
