<?php

/*
 * AlFancybox Widget
 * @author LIAL <dev@instup.com>
 * @link http://instup.com
 *
 * Copyright (c) 2016 by LIAL

 * AlFancybox implements Fancybox as Yii Widget
 * Fancybox site http://fancyapps.com/fancybox/
 * @version: 1.0
 */

class AlFancybox extends CWidget
{
    /**
     * @var string Widget unique identifier
     */
    public $id;

    /**
     * @var string DOM element Fancybox will applied to
     */
    public $targetDOM = 'a.fancied';

    /**
     * @var string DOM element that should be hided if use fancybox
     *             Eg: if we have window content on the same page and would like show it only in fancybox
     */
    public $hideDOM = '';

    /**
     * @var bool Opens window as simple dialog (no border)
     */
    public $asDialog = false;

    /**
     * @var bool Regiser assets for Button helper
     */
    public $helperButton = false;

    /**
     * @var bool Regiser assets for Thumbnails helper
     */
    public $helperThumbs = false;

    /**
     * @var bool Regiser assets for Media helper
     */
    public $helperMedia = false;

    /**
     * @var array Configuration of Fancybox
     * Detailed parameters available on http://fancyapps.com/fancybox/#docs
     */
    public $config = array();

    public function init() {
        if (!isset($this->id))
            $this->id = $this->getId();
        $this->publishAssets();
    }

    public function run() {
        if ($this->asDialog) {
            $config = array(
                'openEffect' => 'none',
                'closeEffect' => 'none',
                'padding'   => 0,
            );
        } else {
            $config = array(
                'openEffect' => 'elastic',
                'openSpeed' => 150,
                'closeEffect' => 'elastic',
                'closeSpeed' => 150,
                'padding'   => 3,
                'helpers' => array(
                    'type' => 'over',
                ),
            );
        }
        $this->config = CMap::mergeArray($this->config, $config);

        $config = CJavaScript::encode($this->config);

        Yii::app()->clientScript->registerScript($this->id, '
            if ("'.$this->hideDOM.'") $("'.$this->hideDOM.'").hide();
			$("'.$this->targetDOM.'").fancybox('.$config.');
		', CClientScript::POS_END);
    }

    public function publishAssets() {
        $assets = dirname(__FILE__) . '/assets';
        $baseUrl = Yii::app()->assetManager->publish($assets, true, -1, YII_DEBUG);

        if (is_dir($assets)) {
            Yii::app()->clientScript->registerCoreScript('jquery');
            Yii::app()->clientScript->registerScriptFile($baseUrl . '/jquery.fancybox.pack.js', CClientScript::POS_HEAD);
            Yii::app()->clientScript->registerCssFile($baseUrl . '/jquery.fancybox.css');

            //Register helpers assets
            //Be sure that registration is only add scripts and styles in your page
            //you should configure helpers separately in config array (Docs: http://fancyapps.com/fancybox/#examples)

            if ($this->helperButton) {
                Yii::app()->clientScript->registerScriptFile($baseUrl . '/helpers/jquery.fancybox-buttons.js', CClientScript::POS_END);
                Yii::app()->clientScript->registerCssFile($baseUrl . '/helpers/jquery.fancybox-buttons.css');
            }

            if ($this->helperThumbs) {
                Yii::app()->clientScript->registerScriptFile($baseUrl . '/helpers/jquery.fancybox-thumbs.js', CClientScript::POS_END);
                Yii::app()->clientScript->registerCssFile($baseUrl . '/helpers/jquery.fancybox-thumbs.css');
            }

            if ($this->helperMedia) {
                Yii::app()->clientScript->registerScriptFile($baseUrl . '/helpers/jquery.fancybox-media.js', CClientScript::POS_END);
            }
        } else {
            throw new Exception('ALFancyBox error: Folder with fancybox assets not exists.');
        }
    }
}