<?php

/*
 * Copyright 2013 Victor Demin <mail@vdemin.com>.
 */

/**
 * Description of BackendController
 *
 * @author Victor Demin <mail@vdemin.com>
 */
class BackendController extends Controller {

    public $layout = '/admin-template';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                //'actions'=>array('admin','delete'),
                'users' => User::getAdmins(),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

}

?>
