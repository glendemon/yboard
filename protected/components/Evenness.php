<?php

/*
 * Copyright 2013 Victor Demin <mail@vdemin.com>.
 */

/**
 * Description of Evenness
 *
 * @author Victor Demin <mail@vdemin.com>
 */
class Evenness extends CApplicationComponent
{
    private $_i = 0;

    public function init()
    {
        $this->_i = 0;
    }

    public function next()
    {
        return ++$this->_i % 2 == 1 ? 'odd' : 'even';
    }

}

?>
