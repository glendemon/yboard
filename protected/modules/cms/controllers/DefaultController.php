<?php

class DefaultController extends Controller
{
    public $layout='//main-template';
	public function actionIndex()
	{
		$this->render('index');
	}
}