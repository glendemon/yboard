<?php

/**
 * BaseController.php
 *
 * Date: 11/15/12
 * Time: 22:46 PM
 *
 * This controllers makes possible for controllers that extend from it to inherit
 * actions from behaviors
 *
 * Idea by Yii user Mimin and  Kevin Higgins
 * @link http://www.yiiframework.com/forum/index.php/user/9488-mimin/
 * @link http://www.yiiframework.com/forum/index.php/user/24587-kevin-higgins/
 * Relevant discussion in Yii Forum
 * @link http://www.yiiframework.com/forum/index.php/topic/10652-actions-by-behavioring/
 *
 */
// Define a path alias for the Bootstrap extension as it's used internally.
// In this example we assume that you unzipped the extension under protected/extensions.
Yii::setPathOfAlias('bootstrap', dirname(__FILE__) . '/../extensions/bootstrap');

function t($str, $dict = 'lang') {
    return Yii::t($dict, $str);
}

class Controller extends CController {

    /**
     * @var string the default layout for the controller view. Defaults to '//layouts/column1',
     * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
     */
    public $breadcrumbs = array();
    private $_behaviorIDs = array();
    public $layout = '//main-template';
    public $menu = array();
    // данные для генерации мета данных title, description, keywords
    public $meta = array();
    public $settings = array();
    public $banners = array();
    public $categories = array();
    public $title = "";

    public function init() {
        parent::init();
    }

    public function __construct($id, $module = null) {

        global $CONFIG;
        
        parent::__construct($id, $module);

        if (!is_file(dirname($CONFIG) . "/install")) {
            $this->settings = require Yii::getPathOfAlias('application.config.settings') . '.php';
            $this->banners = include_once Yii::getPathOfAlias('application.config.banners') . '.php';
            //$this->categories = $this->getCategories();

            Yii::app()->params['categories'] = Category::getCategories();
        } elseif (Yii::app()->getRequest()->getPathInfo() !== "site/install") {
            $this->redirect(Yii::app()->baseUrl . '/site/install');
        }
        $this->meta = Yii::app()->params['meta'];
        $this->meta['vars']['site_name'] = Yii::app()->name;
    }

    public function getBanner($var = false) {
        $debug = "";
        $banner_code = "";
        $cond_banners = array(); // баннеры подходящие по условиям


        if ($var === false) {
            $footer_str = "";
            foreach ($this->banners['__FOOTER__'] as $bn) {
                $footer_str .= $bn;
            }

            return $footer_str;
        }

        if (isset($this->banners[$var]) and sizeof($this->banners[$var]) > 0) {
            if (is_array($this->banners[$var])) {
                // Составление списка баннеров подходящих по условиям 
                foreach ($this->banners[$var] as $b_id => $banner) {
                    if ($banner['enable'] !== "false") {
                        if (is_array($banner['conditions']) and sizeof($banner['conditions']) > 0) {
                            foreach ($banner['conditions'] as $cond) {
                                // Сравнение Get параметров
                                if (isset($cond['parameter'])) {
                                    if ($cond['compare'] === "1") {
                                        if ($_GET[$cond['parameter']] === $cond['value']) {
                                            $cond_banners[] = $b_id;
                                        }
                                    } elseif ($cond['compare'] === "0") {
                                        if ($_GET[$cond['parameter']] !== $cond['value']) {
                                            $cond_banners[] = $b_id;
                                        }
                                    } elseif ($cond['exist'] === "1") {
                                        if (isset($_GET[$cond['parameter']])) {
                                            $cond_banners[] = $b_id;
                                        }
                                    } elseif ($cond['exist'] === "0") {
                                        if (!isset($_GET[$cond['parameter']])) {
                                            $cond_banners[] = $b_id;
                                        }
                                    }
                                }
                                // Сравнение URL 
                                if (isset($cond['url'])) {
                                    if ($cond['compare'] === "1") {
                                        if (Yii::app()->request->requestUri === $cond['url']) {
                                            $cond_banners[] = $b_id;
                                        }
                                    } elseif ($cond['compare'] === "0") {
                                        if (Yii::app()->request->requestUri !== $cond['url']) {
                                            $cond_banners[] = $b_id;
                                        }
                                    }
                                }
                            }
                        } else {
                            $cond_banners[] = $b_id;
                        }
                    }
                }
            } else {
                $banner_code = $this->banners[$var];
            }

            if (sizeof($cond_banners) > 0) {
                // вывод одного из подощедших баннеров
                $b_id = $cond_banners[array_rand($cond_banners, 1)];
                if ($this->banners[$var][$b_id]['title']) {
                    $debug = "\"" . $this->banners[$var][$b_id]['title'] . "\"";
                }
                $banner_code = $this->banners[$var][$b_id]['code'];
                $this->banners['__FOOTER__'][] = $this->banners[$var][$b_id]['code_footer'];
            }
        }

        // var_dump( $this->banners );

        if ($_COOKIE['adv_debug'] === "yes") {
            $debug = "<div style='background:#990000; min-height:20px;' align='center'>" . $var . " - " . $debug . "</div>";
            if (!isset($this->banners[$var]))
                $debug .= "No Ads";
        }

        return "<div class='pblock " . $var . "' >"
                . $debug . $banner_code
                . "</div>";
    }

    public function createAction($actionID) {
        $action = parent::createAction($actionID);
        if ($action !== null)
            return $action;
        foreach ($this->_behaviorIDs as $behaviorID) {
            $object = $this->asa($behaviorID);
            if ($object->getEnabled() && method_exists($object, 'action' . $actionID))
                return new CInlineAction($object, $actionID);
        }
    }

    public function attachBehavior($name, $behavior) {
        $this->_behaviorIDs[] = $name;
        parent::attachBehavior($name, $behavior);
    }

    public function meta_title() {

        echo $this->meta['title'];
        
        $title = $this->subMetaVars($this->meta['title']);
        return $title;
    }

    public function meta_description() {
        
        echo $this->meta['description'];
        
        $description = $this->subMetaVars($this->meta['description']);
        return $description;
    }

    public function subMetaVars($str) {
        return $str;
    }

}
