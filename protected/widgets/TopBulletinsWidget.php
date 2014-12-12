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
		$criteria->limit=10;
		$criteria->order='id desc';
        return Bulletin::model()->findAll($criteria);
    }

}

?>
