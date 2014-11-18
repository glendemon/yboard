<?php

/*
 * Copyright 2013 Victor Demin <mail@vdemin.com>.
 */

/**
 * Description of ConfigForm
 *
 * @author Victor Demin <mail@vdemin.com>
 */
class ConfigForm extends CFormModel
{
    public $top;

    public function rules()
    {
        return array(
            array('top', 'safe'),
        );
    }

    public function attributeLabels()
    {
        return array(
            'top' => Yii::t('main', 'Top'),
        );
    }

}

?>
