<?php

class SettingsController extends BackendController {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '/admin-template';
    public $title = 'Настройки';

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $model = new ConfigForm(Yii::getPathOfAlias('application.config.settings') . '.php');
        $InitConf = $model->getConfig();

        if (isset($_POST['config'])) {

            $model->updateConfig($_POST['config']);

            if ($model->validate()) {

                $model->saveToFile();

                $this->refresh();
            }
        }
        $this->render('/config', array('model' => $model));
    }

}
