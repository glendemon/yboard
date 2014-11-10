<?php

/*
 * Copyright 2013 Victor Demin <mail@vdemin.com>.
 */

/**
 * Show subcagetories for category.
 *
 * @author Victor Demin <mail@vdemin.com>
 */
class SubcategoryWidget extends CWidget
{
    /**
     * @var Category Category to show subcategories
     */
    public $category;

    public function run() {
        $this->render('subcategoryWidget',array('category'=>$this->category));
    }
}
