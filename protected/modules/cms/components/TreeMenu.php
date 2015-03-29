<?php
  
class TreeMenu extends CWidget
{
    public $parent_id = 1;
    
    public $showRoot = false;
    public $tpl = false;
    
    private $model;
    
    
    public function run() 
    {
        Yii::import('application.modules.cms.models.*');
        
        $this->model = Cms::model()->findByPK($this->parent_id);
        $tree = $this->getTreeViewData($this->showRoot,'name');
        if ($this->tpl)
            $this->render($this->tpl,array('tree'=>$tree,));
        else{
            $this->widget('CTreeView', array(
                'data'=>$tree,
                'animated'=>false,
                'persist'=>'location',
            ));
        }
    }
    
    public function getTreeViewData($returnrootnode = true, $keyfield = null)
    {
        if($keyfield == null)
        {
            $keyfield = 'id';
        }
        // Fetch the flat tree
        $rawtree = $this->model->getTree(true);
        // Init variables needed for the array conversion
        $tree = array();
        $node =& $tree;
        $position = array();
        $lastitem = '';
        $depth = $this->model->getLevelValue();
        
        foreach($rawtree as $rawitem)
        {
            // If its a deeper item, then make it subitems of the current item
            if ($rawitem->getLevelValue() > $depth)
            {
                $position[] =& $node; //$lastitem;
                $depth = $rawitem->getLevelValue();
                $node =& $node[$lastitem]['children'];
            }
            // If its less deep item, then return to a level up
            else
            {
                while ($rawitem->getLevelValue() < $depth)
                {
                    end($position);
                    $node =& $position[key($position)];
                    array_pop($position);
                    $depth = $node[key($node)]['node']->getLevelValue();
                }
            }
            
            //if ($rawitem->owner->type==Cms::PAGE) DebugBreak();
            $isLink = $rawitem->owner->type==Cms::LINK;
            $options = array();
            if ($isLink) 
                $options['target'] = '_blank';
            $rawitem->owner->name 
                = CHtml::link($rawitem->owner->name,
                        !$isLink ? array("/".$rawitem->owner->url) : $rawitem->owner->url,
                        $options
                        );

            // Add the item to the final array
            $node[$rawitem->$keyfield]['node'] = $rawitem;
            $node[$rawitem->$keyfield]['id'] = 'node'.$rawitem->owner->id;
            $node[$rawitem->$keyfield]['text'] = $rawitem->owner->name;
            // save the last items' name
            $lastitem = $rawitem->$keyfield;
        }
        // we don't care about the root node
        if (!$returnrootnode)
        {
            reset($tree);
            $tree = $tree[key($tree)]['children'];
            //array_shift($tree);
        }
        
        return $tree;
    }
    
}
  
?>
