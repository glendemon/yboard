<?php

/*
 * Copyright 2013 Victor Demin <mail@vdemin.com>.
 */

/**
 * Description of CountBulletins
 *
 * @author Victor Demin <mail@vdemin.com>
 */
class CountBulletins extends CApplicationComponent
{

    private $_data = array();

    public function init()
    {
        $reader = Yii::app()->db->createCommand()
            ->select('category_id, COUNT(*) count')
            ->from(Bulletin::model()->tableName())
            ->group('category_id')
            ->query();
        foreach($reader as $row)
            $this->_data[$row['category_id']] = $row['count'];
    }

    public function count($category_id)
    {
        return !empty($this->_data[$category_id]) ? $this->_data[$category_id] : 0;
    }

}

?>
