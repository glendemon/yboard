<?php

/*
 * Copyright 2015 Max Uglov <vencendor@mail.ru>
 */

/**
 * Выводит панель продвинутого поиска для определенной категории
 *
 * @author Max Uglov <vencendor@mail.ru>
 * 
 * 
 */
class articleList extends CWidget {

    /**
     * @var CActiveForm form
     */
    public function run() {

        $model = new Cms();
        $art_list = $model->getPageList();

        foreach ($art_list as $art) {
            echo "<a href='" . Yii::app()->baseUrl . "/" . $art->url . "'>" . $art->name . "</a>";
        }
    }

}
