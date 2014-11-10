<?php

/*
 * Copyright 2013 Victor Demin <mail@vdemin.com>.
 */

/**
 * Description of CreateAction
 *
 * @author Victor Demin <mail@vdemin.com>
 */
class CreateAction extends CAction
{
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function run()
	{
		$model=new Bulletin;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Bulletin']))
		{
			$model->attributes = $_POST['Bulletin'];
            $model->user_id = Yii::app()->user->id;

			if($model->save())
            {
                $video = CUploadedFile::getInstances($model, 'youtube_id');
                YoutubeHelper::processBulletin($model, $video);

                $images = CUploadedFile::getInstancesByName('images');
                // proceed if the images have been set
                ImagesHelper::processImages($model, $images);
				$this->controller->redirect(array('site/bulletin','id'=>$model->id));
            }
		}

        $this->controller->render('create', array(
            'model' => $model,
        ));
	}

}

?>
