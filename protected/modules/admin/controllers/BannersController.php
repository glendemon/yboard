<?php

class BannersController extends BackendController
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='/main';

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */

	public function actionShow(){
		ob_get_clean(); 
		?><html><head></head><body>
		<?=$this->banners[$_GET['b_name']][$_GET['b_id']]?>
		</body></html><?		
	}
	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{ 

		$banners_file=Yii::getPathOfAlias('application.config.banners').".php";
		//include $banners_file;

		$save_banners=false;

		if(isset($_GET['create_block']) and isset($_GET['new_name'])){
			if(preg_match("#[-_a-z]{4,}#is",$_GET['new_name'])) {
				$this->banners[$_GET['new_name']]=Array();
				$save_banners=true;
			} else $ERROR['block_name']="Неправельное название для блока";
		}

		if(isset($_POST['insert_ads'])){
			$this->banners[$_POST['block_name']][]=$_POST['ads_code'];
			$save_banners=true;
		}

		if(isset($_GET['delete_block']) ) {
			unset($this->banners[$_GET['delete_block']]);
			$save_banners=true;
		}
		
		if(isset($_GET['delete_name']) and isset($_GET['delete_id'])) {
			unset($this->banners[$_GET['delete_name']][$_GET['delete_id']]);
			$save_banners=true;
		}
	
		if($save_banners){
			file_put_contents($banners_file,"<? return ".var_export($this->banners,true)."; ");
		}
		
		//var_dump($this->banners);


		$this->render('/banners');

	}


	
	
}
