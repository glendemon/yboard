<?php

class WebUser extends CWebUser {

    public $aster = "master";

    public function getRole() {
        return $this->getState('__role');
    }

    public function getId() {
        return $this->getState('__id') ? $this->getState('__id') : 0;
    }

//    protected function beforeLogin($id, $states, $fromCookie)
//    {
//        parent::beforeLogin($id, $states, $fromCookie);
//
//        $model = new UserLoginStats();
//        $model->attributes = array(
//            'user_id' => $id,
//            'ip' => ip2long(Yii::app()->request->getUserHostAddress())
//        );
//        $model->save();
//
//        return true;
//    }

    protected function afterLogin($fromCookie) {
        parent::afterLogin($fromCookie);
        $this->updateSession();
    }

    public function updateSession() {
        $user = User::model()->findByPk($this->id);
        $userAttributes = array(
            'email' => $user->email,
            'username' => $user->username,
            'create_at' => $user->create_at,
            'lastvisit_at' => $user->lastvisit_at,
        );
        foreach ($userAttributes as $attrName => $attrValue) {
            $this->setState($attrName, $attrValue);
        }
    }

    public function getUsername($id = 0) {
        return $this->username;
    }

    public function model($id = 0) {
        return User::model()->findByPk($id);
    }

    public function user($id = 0) {
        return $this->model($id);
    }

    public function getUserByName($username) {
        //return Yii::app()->getModule('user')->getUserByName($username);
        return "Not defined function";
    }

    public function getAdmins() {

        //return Yii::app()->getModule('user')->getAdmins();
        return "Not defined function";
    }

    public function isAdmin() {
        if (Yii::app()->user->isGuest)
            return false;
        else {
            if (Yii::app()->user->superuser)
                return true;
            else
                return false;
        }
    }

    /**
     * @return hash string.
     */
    public static function crypt($string = "") {

        $hash = 'md5';

        $salt = "!~ALZ875(%";

        if ($hash == "md5")
            return md5($string . $salt);
        if ($hash == "sha1")
            return sha1($string . $salt);
        else
            return hash($hash, $string . $salt);
    }

}
