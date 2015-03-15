<?php

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class InstallForm extends CFormModel
{
    public $mysql_server;
    public $mysql_login;
    public $mysql_password;
    public $mysql_db_name;
    public $site_name;

    public $username;
    public $userpass;
    public $userpass2;
    public $useremail;


    /**
     * Declares the validation rules.
     */
    public function rules()
    {
        return array(
            // name, email, subject and body are required
            array('username,userpass, userpass2, useremail, site_name', 'required'),
            array('username,userpass, userpass2, useremail, site_name', 'length', 'max'=>20, 'min' => 3),
            array('mysql_server, mysql_login,  mysql_password, mysql_db_name', 'required'),
            array('mysql_server, mysql_login,  mysql_password, mysql_db_name', 'length', 'max'=>20, 'min' => 3),

            array('useremail', 'email'),
            array('username', 'match', 'pattern' => '/^[A-Za-z0-9_]+$/u',
                'message' => Yii::t('lang',"Incorrect symbols (A-z0-9).")
            ),
            //array('useremail', 'unique', 'message' => Yii::t('lang',"This user's email address already exists.")),
            array('username', 'match', 'pattern' => '/^[A-Za-z0-9_]+$/u',
                'message' => Yii::t('lang',"Incorrect symbols (A-z0-9).")
            ),
            array('userpass', 'compare', 'compareAttribute'=>'userpass2', 
                'message' => Yii::t('lang',"Retype Password is incorrect.")
            )
        );
    }

    /**
     * Declares customized attribute labels.
     * If not declared here, an attribute would have a label that is
     * the same as its name with the first letter in upper case.
     */
    public function attributeLabels()
    {
            return array(

                'site_name'=>'Название сайта',
                'mysql_server'=>'Сервер mysql',
                'mysql_login'=>'Login Mysql',
                'mysql_password'=>'Пароль Mysql',
                'mysql_db_name'=>'Название базы',
                'username'=>'Логин для входа в админку',
                'userpass'=>'Пароль',
                'userpass2'=>'Пароль еще раз',
                'useremail'=>'Емайл администратора',

            );
    }
}