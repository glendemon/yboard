<?php
/**
 * Контролер сайта включающий отдельные возможности 
 * Процедура установки 
 * Форма контактов 
 * Вывод дополнительных поляй для категории actionGetfields 
 */
class SiteController extends Controller {

    /**
     * Declares class-based actions.
     * 
     */
    public $layout = '/main-template';

    public function actions() {
        return array(
            // Дублирование, метода "создание объявления" удален
            // 'create' => 'application.controllers.site.CreateAction',
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }
    /**
     * Получения списка дополнительных полей для категории 
     * используется при созданий объявления
     * @param type $cat_id Id категории 
     */
    public function actionGetfields($cat_id) {
        $model = Category::model()->findByPk($cat_id);

        $fields = json_decode($model->fields);

        if (sizeof($fields) > 0) {
            foreach ($fields as $f_iden => $fv) {
                ?><div class="controls">
                    <label for='Fields[<?= $f_iden ?>]'><?= $fv->name ?></label>
                    <input type="text" id="Fields[<?= $f_iden ?>]" name="Fields[<?= $f_iden ?>]" >
                </div><?
            }
        }
    }

    public function accessRules() {
        return array(
            array('allow', // allow all users to perform actions
                'actions' => array('index', 'error', 'contact', 'bulletin', 'category', 'captcha', 'page', 'advertisement', 'getfields', 'search'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user
                'actions' => array('create'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user
                'actions' => array('importUsers', 'importBulletins'),
                'users' => array('admin'),
            ),
        );
    }

    /**
     * Вывод главной
     * отличается наличием виджета категорий вверху
     */
    public function actionIndex() {
        $roots = Category::model()->roots()->findAll();
        $criteria = new CDbCriteria();
        $criteria->limit = 10;
        $criteria->order = 'id desc';
        $IndexAdv = Adverts::model()->findAll($criteria);
        $this->render('index', array(
            'roots' => $roots,
            'IndexAdv' => $IndexAdv,
        ));
    }

    public function actionInstall() {
        global $CONFIG; // Путь к файлу конфигурации для его изменения
        $this->layout = "/install-layout";
        $db_error = false;
        $model = new InstallForm;

        if (!isset(Yii::app()->components['db'])) {

            if (isset($_POST['InstallForm'])) {
                $model->attributes = $_POST['InstallForm'];

                // данные Mysql 
                $server = trim(stripslashes($_POST['InstallForm']['mysql_server']));
                $username = trim(stripslashes($_POST['InstallForm']['mysql_login']));
                $password = trim(stripslashes($_POST['InstallForm']['mysql_password']));
                $db_name = trim(stripslashes($_POST['InstallForm']['mysql_db_name']));

                // данные пользователя                     
                if (!$model->validate() or $model->userpass !== $model->userpass2) {
                    $db_error = "Данные пользователя неправльные";
                }

                $db_con = @mysqli_connect($server, $username, $password) or $db_error = mysqli_error();
                @mysqli_select_db($db_con, $db_name) or $db_error = mysqli_error($db_con);

                if (!$db_error) {
                    $config_data = require $CONFIG;

                    $dump_file = file_get_contents(Yii::getPathOfAlias('application.data.install') . '.sql');

                    // Сохранение данных о пользователе 
                    $dump_file.=" INSERT INTO `users` 
                                    (`username`, `password`, `email`, `activkey`, `superuser`, `status`)     VALUES "
                            . "('" . $model->username . "', '" . UserModule::encrypting($model->userpass) . "', "
                            . "'" . $model->useremail . "', '" . UserModule::encrypting(microtime() . $model->userpass) . "',"
                            . " 1, 1);";

                    mysqli_multi_query($db_con, $dump_file) or $db_error = mysqli_error($db_con);

                    if (!$db_error) {
                        // Заполнение конфигурации
                        $config_data['components']['db'] = array(
                            'connectionString' => 'mysql:host=' . $server . ';dbname=' . $db_name,
                            'emulatePrepare' => true,
                            'username' => $username,
                            'password' => $password,
                            'charset' => 'utf8',
                            'tablePrefix' => '',
                        );
                        $config_data['name'] = trim(stripslashes($_POST['InstallForm']['site_name']));
                        $config_data['params']['adminEmail'] = $model->useremail;
                        $config_data['params']['installed'] = "yes";

                        //Сохранение конфигурации
                        file_put_contents($CONFIG, "<? return " . var_export($config_data, true) . " ?>");

                        $this->redirect(Yii::app()->createUrl('site/index'));
                    }
                }
            }
            $this->render('install', array('model' => $model, 'db_error' => $db_error));
        }
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {
        //$this->layout = "/install-layout";
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    public function actionAbout() {
        $this->render('pages/about');
    }

    /**
     * Displays the contact page
     * @param int $id User's id
     */
    public function actionContact($id = null) {
        $user = $id ? $this->loadUser($id) : null;
        $model = new ContactForm;
        if (isset($_POST['ContactForm'])) {
            $model->attributes = $_POST['ContactForm'];
            if ($model->validate()) {
                $name = '=?UTF-8?B?' . base64_encode($model->name) . '?=';
                $subject = '=?UTF-8?B?' . base64_encode($model->subject) . '?=';
                $headers = "From: $name <{$model->email}>\r\n" .
                        "Reply-To: {$model->email}\r\n" .
                        "MIME-Version: 1.0\r\n" .
                        "Content-type: text/plain; charset=UTF-8";
                $mail = $user ? $user->email : Yii::app()->params['adminEmail'];

                mail($mail, $subject, $model->body, $headers);
                Yii::app()->user->setFlash('contact', 'Thank you for contacting us. We will respond to you as soon as possible.');
                $this->refresh();
            }
        }
        $this->render('contact', array('model' => $model, 'user' => $user));
    }

    public function actionView($id) {
        $model = $this->loadAdvert($id);
        $model->views++;
        $model->disableBehavior('CTimestampBehavior');
        $model->save();
        $this->render('bulletin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return User the loaded model
     * @throws CHttpException
     */
    public function loadAdvert($id) {
        $model = loadAdvert::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return User the loaded model
     * @throws CHttpException
     */
    public function loadCategory($id) {
        $model = Category::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return User the loaded model
     * @throws CHttpException
     */
    public function loadUser($id) {
        $model = User::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

}

