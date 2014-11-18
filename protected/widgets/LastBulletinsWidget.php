<?php

/*
 * Copyright 2013 Victor Demin <mail@vdemin.com>.
 */

/**
 * Description of LastBulletinsWidget
 *
 * @author Victor Demin <mail@vdemin.com>
 */
class LastBulletinsWidget extends CWidget
{
    /**
     * @var int Count of last bulletins
     */
    public $limit = 20;

    public function run()
    {
        $this->render('lastBulletinsWidget', array('bulletins' => $this->lastBulletins()));
    }

    public function lastBulletins()
    {
        $dataProvider=new CActiveDataProvider('Bulletin', array(
            'criteria'=>array(
                'order'=>'id DESC',
                'limit'=>$this->limit,
            ),
        ));
        return $dataProvider->getData();
    }

}

?>
