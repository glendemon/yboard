<?php

/*
 * Copyright 2013 Victor Demin <mail@vdemin.com>.
 */

/**
 * Description of ShowAdvertisementWidget
 *
 * @author Victor Demin <mail@vdemin.com>
 */
class ShowAdvertisementWidget extends CWidget
{
    /**
     * @var int
     */
    public $offset = 0;

    /**
     * @var int
     */
    public $limit = 10;

    public function run()
    {
        $this->render('showAdvertisementWidget', array('data' => $this->loadAdvertisement()));
    }

    /**
     * @return Advertisement[]
     */
    protected function loadAdvertisement()
    {
        $dataProvider=new CActiveDataProvider('Advertisement', array(
            'criteria'=>array(
                'order'=>'`order` ASC, id ASC',
                'offset'=>$this->offset,
                'limit'=>$this->limit,
            ),
        ));
        $dataProvider->setPagination(false);
        return $dataProvider->getData();
    }

}

?>
