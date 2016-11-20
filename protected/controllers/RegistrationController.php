<?php

class RegistrationController extends Controller {

    public $defaultAction = 'registration';

    /**
     * Declares class-based actions.
     */
    public function actions() {
        return array(
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
        );
    }

    /**
     * Registration user
     */
    public function actionRegistration() {
        $model = new RegistrationForm;


        // ajax validator
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'registration-form') {
            //echo UActiveForm::validate(array($model, $profile));
            $model->validate();
            $model->getErrors();
            Yii::app()->end();
        }

        if (Yii::app()->user->id) {
            $this->redirect(Yii::app()->controller->module->profileUrl);
        } else {
            if (isset($_POST['RegistrationForm'])) {
                $model->attributes = $_POST['RegistrationForm'];
                //$profile->attributes = ((isset($_POST['Profile']) ? $_POST['Profile'] : array()));
                if ($model->validate()) {
                    $soucePassword = $model->password;
                    $model->activkey = Yii::app()->user->crypt(microtime() . $model->password);
                    $model->password = Yii::app()->user->crypt($model->password);
                    $model->verifyPassword = Yii::app()->user->crypt($model->verifyPassword);
                    $model->superuser = 0;
                    $model->status = ((Yii::app()->controller->module->activeAfterRegister) ? User::STATUS_ACTIVE : User::STATUS_NOACTIVE);

                    if ($model->save()) {
                        //$profile->user_id = $model->id;
                        //$profile->save();
                        if (Yii::app()->controller->module->sendActivationMail) {
                            $activation_url = $this->createAbsoluteUrl('/user/registration/activation', array("activkey" => $model->activkey, "email" => $model->email));
                            
                            Yii::app()->email->to = $model->email;
                            Yii::app()->email->subject = t("You registered from {site_name}", array('{site_name}' => Yii::app()->name));
                            Yii::app()->email->message = t("Please activate you account go to {activation_url}", array('{activation_url}' => $activation_url, '{username}' => $model->username, '{password}' => $model->password, '{site_name}' => Yii::app()->name));
                            Yii::app()->email->send();

                        }

                        if ((Yii::app()->controller->module->loginNotActiv || (Yii::app()->controller->module->activeAfterRegister && Yii::app()->controller->module->sendActivationMail == false)) && Yii::app()->controller->module->autoLogin) {
                            $identity = new UserIdentity($model->username, $soucePassword);
                            $identity->authenticate();
                            Yii::app()->user->login($identity, 0);
                            $this->redirect(Yii::app()->controller->module->returnUrl);
                        } else {
                            if (!Yii::app()->controller->module->activeAfterRegister && !Yii::app()->controller->module->sendActivationMail) {
                                Yii::app()->user->setFlash('registration', t("Thank you for your registration. Contact Admin to activate your account."));
                            } elseif (Yii::app()->controller->module->activeAfterRegister && Yii::app()->controller->module->sendActivationMail == false) {
                                Yii::app()->user->setFlash('registration', t("Thank you for your registration. Please {{login}}.", array('{{login}}' => CHtml::link(t('Login'), Yii::app()->controller->module->loginUrl))));
                            } elseif (Yii::app()->controller->module->loginNotActiv) {
                                Yii::app()->user->setFlash('registration', t("Thank you for your registration. Please check your email or login."));
                            } else {
                                Yii::app()->user->setFlash('registration', t("Thank you for your registration. Please check your email."));
                            }
                            $this->refresh();
                        }
                    }
                }  // else
                    //$profile->validate();
            }
            $this->render('/user/registration', array('model' => $model ));

        }
    }

    
    public function actionActivation() {
        $email = $_GET['email'];
        $activkey = $_GET['activkey'];
        if ($email && $activkey) {
            $find = User::model()->notsafe()->findByAttributes(array('email' => $email));
            if (isset($find) && $find->status) {
                $this->render('/user/message', array(
                    'title' => t("User activation"), 
                    'content' => t("You account is active.")
                    )
                );
            } elseif (isset($find->activkey) && ($find->activkey == $activkey)){
                $find->activkey = Yii::app()->user->crypt(microtime());
                $find->status = 1;
                $find->save();
                $this->render('/user/'. $find->id, array(
                    'title' => t("User activation"), 
                    'content' => t("You account is activated.")
                ));
            } else {
                $this->render('/user/message', array(
                    'title' => t("User activation"), 
                    'content' => t("Incorrect activation URL.")
                ));
            }
        } else {
            $this->render('/user/message', array(
                'title' => t("User activation"), 
                'content' => t("Incorrect activation URL.")
            ));
        }
    }
}
