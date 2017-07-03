<?php

class AdvertsController extends Controller {

    public $layout = '//main-template';

    public function actions() {
        return array(
            'create' => 'application.controllers.site.CreateAction',
            //'importUsers' => 'application.controllers.site.ImportUsersAction' ,
            //'importAdvertss' => 'application.controllers.site.ImportAdvertssAction' ,
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array('class' => 'CCaptchaAction', 'backColor' => 0xFFFFFF,),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array('class' => 'CViewAction',),
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            // allow all users to perform actions
            array('allow',
                'actions' => array('index', 'error', 'view', 'favorites', 'contact', 'bulletin', 'category', 'captcha', 'page', 'advertisement', 'getfields', 'search', 'user'),
                'users' => array('*'),
            ),
            // allow authenticated user
            array('allow', 'actions' => array('create'),
                'users' => array('@'),
            ),
            // allow admin user
            array('allow', 'actions' => array('importUsers', 'importAdvertss'),
                'users' => array('admin'),
            ),
                /*
                  array('deny',  // deny all users
                  'users'=>array('*'),
                  ),
                 * 
                 */
        );
    }

    public function actionSetFavorites($id) {
        $model = Favorites::model()->find(" user_id='" . Yii::app()->user->id
                . "' and obj_id='" . $id . "' and obj_type='0'");
        if ($model) {
            $model->delete();
            echo 'false';
        } else {
            $model = New Favorites();
            $model->user_id = Yii::app()->user->id;
            $model->obj_id = $id;
            $model->obj_type = 0;
            $model->save();
            echo 'true';
        }
    }

    public function actionFavorites() {

        $dataProvider = new CActiveDataProvider('Adverts', array(
            'criteria' => array(
                'select' => 't.*, IFNULL(updated_at, created_at) as sort',
                'condition' => 't.user_id = "' . (int) Yii::app()->user->id . '"',
                'order' => 'sort DESC',
                //'params' => array(':uid' =>  ),
                'join' => 'inner join users on users.id=favorites.user_id ',
                'join' => 'inner join favorites on t.id=favorites.obj_id ',
            ),
        ));


        $this->render('index', array(
            'data' => $dataProvider,
        ));

    }

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    public function actionGetfields($cat_id) {

        $model_count = Category::model()->count(array(
            'select' => 'count(*) as cnt',
            'condition' => 'root=' . $cat_id,
        ));

        // Получение категории
        $model = Category::model()->findByPk($cat_id);

        // Проверка есть ли дочерние 
        if ($model->lft + 1 == $model->rgt) {

            echo "<div id='fields_list'>";
            $fields = json_decode($model->fields);

            if (sizeof($fields) > 0)
                foreach ($fields as $f_iden => $fv) {
                    ?>
                    <div class="controls">
                        <label for='Fields[<?= $f_iden ?>]'><?= $fv->name ?></label>
                        <? if ($fv->type == 1) { ?>
                            <input type="checkbox" id="Fields[<?= $f_iden ?>]" name="Fields[<?= $f_iden ?>]" <? ($fv->atr ? "checked='checked'" : "") ?> >
                            <?
                        } elseif ($fv->type == 2) {
                            echo CHtml::dropDownList("Fields[" . $f_iden . "]", array()
                                    , explode(",", $fv->atr));
                        } else {
                            ?>
                            <input type="text" id="Fields[<?= $f_iden ?>]" name="Fields[<?= $f_iden ?>]" >
                        <? } ?>
                    </div>	

                    <?
                }

            echo "</div>";

            echo '<input type="hidden" class="error" value="' . $cat_id . '" '
            . 'id="Adverts_category_id" name="Adverts[category_id]">';
        } else {
            // Вывод дочерних категории
            $subcat = Yii::app()->db->createCommand('select id,name  from category  '
                            . 'where root=' . $model->root . ' and lft>' . $model->lft . ' '
                            . 'and rgt<' . $model->rgt . ' and level=' . ($model->level + 1) . ' ')->query();



            $drop_cats = array();

            foreach ($subcat as $cat) {

                $drop_cats[$cat['id']] = $cat['name'];
            };

            echo CHtml::dropDownList('subcat_' . $cat_id, 0, $drop_cats, array('empty' => t('Choose category'), 'onchange' => 'loadFields(this)'));

            return;
        }
    }

    public function actionUpdate($id) {
        $model = $this->loadAdverts($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Reviews'])) {
            $model->attributes = $_POST['Reviews'];
            if( $_POST['Adverts']['no_price']==="on" ){
                $model->price = 0;
            }
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex() {
        
        $criteria = array(
            'criteria' => array(
                'limit' => '10',
                'order' => 'id DESC',
                
            ));
        
        if( Yii::app()->params['moder_type'] ){
            $criteria['criteria']['condition']='moderated=1';
        }

        $dataProvider = new CActiveDataProvider('Adverts', $criteria
        );
        
        if(Yii::app()->request->getParam('Adverts_page')) {
            Yii::app()->params['meta']['vars']['page_number'] = 
                Yii::app()->request->getParam('Adverts_page');
        }

        $this->render('index', array(
            'data' => $dataProvider,
        ));
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    /**
     * Displays the contact page
     * @param int $id User's id
     */
    public function actionCreate() {

        $model = new Adverts;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Adverts'])) {
            $model->attributes = $_POST['Adverts'];
            $model->user_id = Yii::app()->user->id;
            $model->created_at = date("Y-m-d H:i:s");
            $model->fields = serialize($_POST['Fields']);
            if( $_POST['Adverts']['no_price']==="on" ){
                $model->price = 0;
            }
            
            if ($model->save()) {
                $video = CUploadedFile::getInstances($model, 'youtube_id');
                //YoutubeHelper::processAdverts($model, $video);

                $images = CUploadedFile::getInstancesByName('images');
                // proceed if the images have been set
                ImagesHelper::processImages($model, $images);
                $this->redirect(array('adverts/view', 'id' => $model->id));
            }
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Show bulletin.
     * @param int $id Adverts's id
     */
    public function actionView($id) {

        // Модель для моментального сообщения со страницы просмотра объявления
        $mes_model = new Messages();
        $model = $this->loadAdverts($id);
        $model->views++;
        $model->disableBehavior('CTimestampBehavior');
        $model->save();
        $model->fields = unserialize($model->fields);
        
        $this->meta = Yii::app()->params['adv_meta'];
        $this->meta['vars']['cat_name'] = 
                Yii::app()->params['categories'][$model->category_id]['name'];
        $this->meta['vars']['adv_title'] = $model->name;
        
        // Похожие объявления   
        $dataRel = new CActiveDataProvider('Adverts', array(
            'criteria' => array(
                'select' => 't.*',
                'condition' => 't.category_id = '.$model->category_id ." and t.id != ".$model->id,
                'order' => 'id DESC',
                'limit' => 5,
            ),
        ));

        $this->render('view', array(
            'model' => $model,
            'mes_model' => $mes_model,
            'dataRel' => $dataRel,
        ));
    }

    /**
     * Show category.
     * @param int $cat_id Category's id
     */
    public function actionCategory($cat_id) {

        $dataProvider = new CActiveDataProvider('Adverts', array(
            'criteria' => array(
                'select' => 't.*, IFNULL(updated_at, created_at) as sort',
                'condition' => 't.category_id = :id or (category.lft > :cat_lft '
                . 'and category.rgt< :cat_rgt and category.root = :cat_root)',
                'order' => 'sort DESC',
                'params' => array(
                    ':id' => (int) $cat_id,
                    ':cat_lft' => Yii::app()->params['categories'][$cat_id]['lft'],
                    ':cat_rgt' => Yii::app()->params['categories'][$cat_id]['rgt'],
                    ':cat_root' => Yii::app()->params['categories'][$cat_id]['root'],
                    ':cat_root' => Yii::app()->params['categories'][$cat_id]['root'],
                ),
                'limit' => Yii::app()->params['adv_on_page'],
                'join' => 'inner join category on category.id=t.category_id ',
            ),
        ));

        $this->meta['vars']['cat_name'] = Yii::app()->params['categories'][$cat_id]['name'];

        $this->render('category', array(
            'model' => $this->loadCategory($cat_id),
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Show category.
     * @param int $id User's id
     */
    public function actionUser($id) {

        $dataProvider = new CActiveDataProvider('Adverts', array(
            'criteria' => array(
                'select' => '*, IFNULL(updated_at, created_at) as sort',
                'condition' => 'user_id = :id',
                'order' => 'sort DESC',
                'params' => array(':id' => (int) $id),
            ),
        ));

        $this->render('index', array(
            //'model'=>$this->loadCategory($cat_id),
            'data' => $dataProvider,
        ));
    }

    /**
     * Show Advertisement.
     * @param int $id Advertisement's id
     */
    public function actionAdvertisement($id) {
        $model = $this->loadAdvertisement($id);
        $this->render('advertisement', array(
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
    public function loadAdverts($id) {
        $model = Adverts::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }

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
    public function loadAdvertisement($id) {
        $model = Advertisement::model()->findByPk($id);
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

    public function actionSearch($searchStr = "") {
        $model = new Adverts('search');
        $results = true;

        $model->unsetAttributes();  // clear any default values

        if ($searchStr) {
            $model->name = $searchStr;
            $model->text = $searchStr;
        }
        $model->category_id = Yii::app()->request->getParam("cat_id");
        $model->location = Yii::app()->request->getParam("Adverts")['location'];
        $model->price_min = Yii::app()->request->getParam("Adverts")['price_min'];
        $model->price_max = Yii::app()->request->getParam("Adverts")['price_max'];
        
        // Обработка дополнительных полей для поиска 
        $s_fields = $_GET['fields'];
        $txt_vld = new textValidator();

        if (is_array($s_fields)) {
            ksort($s_fields);
            foreach ($s_fields as $fn => $fv) {
                if ($fv!=="") {
                    if ($txt_vld->validate_str($fv) and $txt_vld->validate_str($fn)) {
                        if ($model->fields) {
                            $model->fields .= "%";
                        }
                        $model->fields .= '"' . $fn . '"[^"]+"' . $fv . '"';
                    } else {
                        throw new CHttpException(400, ' Bad Request ');
                    }
                }
            }
        }

        $dataProvider = $model->search();
        
        if( $dataProvider->getItemCount() == 0 ){
            $model->unsetAttributes();
            $model->name = $searchStr;
            $model->text = $searchStr;
            $dataProvider = $model->search(false);
            $results = false;
        }

        $this->render('index', array(
            'data' => $dataProvider, 'results' => $results
        ));
    }

}
