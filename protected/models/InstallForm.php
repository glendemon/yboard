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

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			// name, email, subject and body are required
			array('mysql_server, mysql_login, mysql_password, mysql_db_name, site_name ', 'required'),
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
            'mysql_server'=>'Сервер mysql',
            'mysql_login'=>'Login Mysql',
            'mysql_password'=>'Пароль Mysql',
			'mysql_db_name'=>'Название базы',
            'site_name'=>'Название сайта',
		);
	}
}