<?php

/*
 * Copyright 2013 Victor Demin <mail@vdemin.com>.
 */

/**
 * Show radiobuttons to choose bulletin's type.
 *
 * @author Victor Demin <mail@vdemin.com>
 */
class BulletinTypeWidget extends CWidget
{
    /**
     * @var CActiveForm form
     */
    public $form;

    /**
     * @var Bulletin model
     */
    public $model;

    public function run() {
        $this->render('bulletinTypeWidget',
            array('model'=>$this->model, 'form'=>$this->form));
    }

}

?>
