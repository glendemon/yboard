<?php

/**
 * This is the model class for table "category".
 *
 * The followings are the available columns in table 'category':
 * @property integer $id
 * @property string $name
 * @property string $icon
 */
class Category extends CActiveRecord
{

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Category the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'category';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name', 'required'),
            array('name, icon', 'length', 'max' => 255),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, name, icon, fields', 'safe', 'on' => 'search'),

        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'bulletins' => array(self::HAS_MANY, 'Bulletin', 'category_id'),
        );
    }
	
	// Формирование поля items для виджета Cmenu для Меню Категории
	public function menuItems($cat_id){
		$catlist=self::model()->findAll("level='1'");
		$catMenuItems=Array();
		foreach($catlist as $cat){
			$catItem=Array();
			$catItem['label']=$cat->name;
			$catItem['url']=array("/category/".$cat->id);
			//Вывод подкатегории для выбраной категории
			if($cat->id==$cat_id){
				$subCat=self::model()->findAll("lft>'".$cat->lft."' and rgt<'".$cat->rgt."' and level='".($cat->level+1)."'");
				$subItem=array();
				if(sizeof($subCat)>0){
					foreach($subCat as $scat){
						$subItem['label']=$scat->name;
						$subItem['url']=array("/category/".$scat->id);
						$catItem['items'][]=$subItem;
					}
				}
			}
			$catMenuItems[]=$catItem;
		}

		return $catMenuItems;
	}

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'name' => 'Name',
            'icon' => 'Icon',
			'fields' => 'Дополнительные поля',

        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('icon', $this->icon, true);
		$criteria->compare('fields', $this->fields, true);


        return new CActiveDataProvider($this, array(
                'criteria' => $criteria,
            ));
    }
	
	public function fieldsSave(){
		$fields=Array();
		foreach($_POST['Category']['fields'] as $fn=>$fd){
			if(preg_match('#fn_[0-9]+#is',$fn))
				$fields[Translit::latin($fd['name'])]=$fd;
			else
				$fields[$fn]=$fd;
		}
				
		$this->fields=json_encode($fields);
	}


    public function behaviors()
    {
        return array(
            'NestedSetBehavior' => array(
                'class' => 'application.behaviors.NestedSetBehavior',
                'leftAttribute' => 'lft',
                'rightAttribute' => 'rgt',
                'levelAttribute' => 'level',
                'hasManyRoots' => true
            ),
        );
    }

    public function countBulletins()
    {
        $count = Yii::app()->countBulletins->count($this->id);
        if ($this->isRoot())
        {
            $descendants=$this->children()->findAll();
            foreach ($descendants as $descendant)
            {
                $count += $descendant->countBulletins();
            }
        }
        return $count;
    }

}