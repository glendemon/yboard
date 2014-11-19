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
<<<<<<< HEAD
    public $answer;
=======
>>>>>>> origin/master

    public function rules()
    {
        return array(
<<<<<<< HEAD
            array('top, answer', 'safe'),
            array('increase_views', 'numerical', 'integerOnly'=>true),
=======
            array('top', 'safe'),
>>>>>>> origin/master
        );
    }

    public function attributeLabels()
    {
        return array(
            'top' => Yii::t('main', 'Top'),
<<<<<<< HEAD
            'answer' => Yii::t('main', 'Answers'),
=======
>>>>>>> origin/master
        );
    }

}

?>
