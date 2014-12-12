<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class DeliveryController extends BackendController
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='/admin-template';
	public $title="Рассылка";

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */

	/**
	 * Lists all models.
	 */
	
	public function actionIndex()
	{ 
		if($_SERVER['REQUEST_METHOD']==="POST" or true){
			
			//Yii::app()->email->send("wzcc@mail.ru","test","test");
			
		}
		$this->render('/delivery');

	}


	
	
}
