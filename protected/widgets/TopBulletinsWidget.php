<?php

/*
 * Copyright 2013 Victor Demin <mail@vdemin.com>.
 */

/**
 * Description of LastBulletinsWidget
 *
 * @author Victor Demin <mail@vdemin.com>
 */
class TopBulletinsWidget extends CWidget
{
    /**
     * @var int Count of last bulletins
     */
    public $limit = 20;

    public function run()
    {
        $this->render('topBulletinsWidget', array('bulletins' => $this->loadBulletins()));
    }

    public function loadBulletins()
    {
        $ids = Yii::app()->config->get('top');
        $criteria = new CDbCriteria();
        $criteria->addInCondition("id", $ids);
        return Bulletin::model()->findAll($criteria);
    }

}

?>
