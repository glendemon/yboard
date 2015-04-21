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
class advancedSearch extends CWidget {

    /**
     * @var CActiveForm form
     */
    public function run() {

        $cat_id = Yii::app()->request->getParam('cat_id');

        if (isset(Yii::app()->params['categories'][intval($cat_id)])) {
            $curent_cat = Yii::app()->params['categories'][$cat_id];
        } else {
            return false;
        }

        echo "<form action='" . Yii::app()->createUrl("/adverts/search") . "'>";
        // Проверка есть ли дочерние 
        if ($curent_cat['lft'] + 1 != $curent_cat['rgt']) {

            $subcat = Yii::app()->db->createCommand('select id,name  from category  '
                            . 'where root=' . $curent_cat['root'] . ' and lft>' . $curent_cat['lft'] . ' '
                            . 'and rgt<' . $curent_cat['rgt'] . ' and level=' . ($curent_cat['level'] + 1) . ' ')->query();
            if ($subcat) {
                ?>
                Подкатегория : <select name='cat_id'>
                    <option value='<?= $cat_id ?>'>  ---  </option>
                <?
                foreach ($subcat as $scat) {
                    echo "<option value='" . $scat['id'] . "'>" . $scat['name'] . "</option>";
                }
                ?>
                </select> <br/>
                <?
            }
        } else {
            echo "<input type='hidden' name='cat_id' value='$cat_id' />";
        }
        if (is_array($curent_cat['fields'])) {
            foreach ($curent_cat['fields'] as $f_id => $field) {
                if ($field['type'] === "1") {
                    echo "<input type='checkbox' name='fields[$f_id]' /> " . $field['name'] . "<br/>";
                } elseif ($field['type'] === "2") {
                    echo $field['name'] . "<select name='fields[$f_id]'> ";
                    echo "<option value=''></option>";
                    foreach ($field['atr'] as $a_n => $atr) {
                        echo "<option value='$a_n'>$atr</option>";
                    }
                    echo "</select>";
                }
            }
        }

        echo "<br/>";
        echo "<input type='hidden' name='searchStr' value='" . Yii::app()->request->getParam('searchStr') . "' /> ";
        echo "<input type='submit' class='btn' value='Поиск' /> ";
        echo "</form>";
    }

}
