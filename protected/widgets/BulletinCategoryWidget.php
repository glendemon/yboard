<?php

/*
 * Copyright 2013 Victor Demin <mail@vdemin.com>.
 */

/**
 * Show dropdown list with categories.
 *
 * @author Victor Demin <mail@vdemin.com>
 */
class BulletinCategoryWidget extends CWidget
{

    /**
     * @var CActiveForm form
     */
    public $form;

    /**
     * @var Bulletin model
     */
    public $model;

    public function run()
    {
        $this->render('bulletinCategoryWidget', array('model' => $this->model, 'form' => $this->form, 'categories' => $this->categoriesListData()));
    }

    public function categoriesListData()
    {
        $categoriesTree = Category::model()->roots()->findAll();
        $categories = array();
        foreach ($categoriesTree as $category)
        {
            $categories[$category->name] = CHtml::listData($category->children()->findAll(), 'id', 'name');
        }
        return $categories;
    }

}

?>
