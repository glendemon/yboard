<?php
  
class Menu extends CWidget
{
    public $attributes = array('parent_id'=>1);
    public $tpl = false;
    
    private $model;
    
    public function run() 
    {
        Yii::import('application.modules.cms.models.*');
        $items = $this->getMenu();
        
        $this->owner->widget('zii.widgets.CMenu', array(
            'items'=>$items,
            'activateItems'=>false,
            'activateParents'=>false,
        ));
    }
    
    private function getMenu()
    {
        if ($items = Cms::model()->findAllByAttributes($this->attributes))
        { 
            $menu = array();
            $menu[] = array('label'=>'Home','url'=>array('/'));
            foreach ($items as $item)
            {
                $menu[] = array('label'=>$item->name,'url'=>array('/'.$item->url));
            }
            return $menu;
        }
        return array();
    }
}
  
?>
