<?php

class LoginController extends Controller
{
	public $defaultAction = 'login';

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		if (Yii::app()->user->isGuest) {
			$model=new UserLogin;
			// collect user input data
			if(isset($_POST['UserLogin']))
			{
				$model->attributes=$_POST['UserLogin'];
				// validate user input and redirect to previous page if valid
				if($model->validate()) {
					$this->lastViset();
					if (Yii::app()->user->returnUrl=='/index.php')
						$this->redirect(Yii::app()->controller->module->returnUrl);
					else
						$this->redirect(Yii::app()->user->returnUrl);
				}
			}
			// display the login form
			$this->render('/user/login',array('model'=>$model));
		} else
			$this->redirect(Yii::app()->controller->module->returnUrl);
	}
        
        public function actionUlogin() {

            if (isset($_POST['token'])) {
                $ulogin = new UloginModel();
                $ulogin->setAttributes($_POST);
                $ulogin->getAuthData();

                if ($ulogin->validate() && $ulogin->login()) {
                    $this->redirect(Yii::app()->user->returnUrl);
                }
                else {

                    $this->render('error', array('errors'=>$ulogin->errors));
                }
            }
            else {

                $this->redirect(Yii::app()->homeUrl, true);
            }
        }
	
	private function lastViset() {
		$lastVisit = User::model()->notsafe()->findByPk(Yii::app()->user->id);
		$lastVisit->lastvisit = time();
		$lastVisit->save();
	}
        
        public function actionLogout()
        {
            Yii::app()->user->logout();
            $this->redirect(Yii::app()->homeUrl);
        }

}