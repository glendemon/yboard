<?php

/*
 * Copyright 2013 Victor Demin <mail@vdemin.com>.
 */

/**
 * Description of LastBulletinsWidget
 *
 * @author Victor Demin <mail@vdemin.com>
 */
class ShowImagesWidget extends CWidget
{
    /**
     * @var Bulletin
     */
    public $bulletin;

    public function run()
    {
        $this->render('showImagesWidget', array('bulletin' => $this->bulletin));
    }

}

?>
