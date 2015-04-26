<?php

/**
 * This is the model class for table "adverts".
 *
 * The followings are the available columns in table 'bulletin':
 * @property integer $id
 * @property string $name
 * @property integer $user_id
 * @property integer $category_id
 * @property boolean $type
 * @property integer $views
 * @property string $text
 */
class Adverts extends CActiveRecord
{

    const TYPE_DEMAND = 0;
    const TYPE_OFFER = 1;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Bulletin the static model class
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
        return 'adverts';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, user_id, category_id, text', 'required'),
            array('user_id, category_id, gallery_id, views, location, currency', 'numerical', 'integerOnly' => true),
            array('name', 'length', 'max' => 255),
            array('email', 'mail'),
            array('price', 'type', 'type' => 'float'),
            array('type', 'safe'),
            array('created_at, updated_at', 'default', 'setOnEmpty'=>true, 'value'=>null),
            array('youtube_id', 'file', 'types'=>'mov, mpeg4, avi, wmv, mpegps, flv, 3gpp, webm', 'allowEmpty' => true),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, name, user_id, category_id, type, views, text, price, currency', 'safe', 'on' => 'search'),
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
            'user' => array(self::BELONGS_TO, 'User', 'user_id'),
            'category' => array(self::BELONGS_TO, 'Category', 'category_id'),
            'gallery' => array(self::BELONGS_TO, 'Gallery', 'gallery_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => t( 'ID'),
            'name' => t( 'Name'),
            'user_id' => t( 'User'),
            'category_id' => t( 'Category'),
            'type' => t( 'Type'),
            'views' => t( 'Views'),
            'text' => t( 'Text'),
            'gallery_id' => t( 'Gallery'),
            'youtube_id' => t( 'Youtube'),
            'created_at' => t( 'Created At'),
            'updated_at' => t( 'Updated At'),
            'fields' => t('Fields'),
            'price' => t('Price'),
            'location' => t('Location'),
        );
    }

    public static function itemAlias($type, $code = NULL)
    {
        $_items = array(
            'type' => array(
                self::TYPE_DEMAND => t( 'Demand'),
                self::TYPE_OFFER => t( 'Offer'),
            ),
        );
        if (isset($code))
            return isset($_items[$type][$code]) ? $_items[$type][$code] : false;
        else
            return isset($_items[$type]) ? $_items[$type] : false;
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
        $criteria->compare('user_id', $this->user_id);
        
        //$criteria->compare('category_id', $this->category_id);
        $criteria->addCondition('t.category_id = "'.$this->category_id.'" '
        . ' or (category.lft > "'.Yii::app()->params['categories'][$this->category_id]['lft'].'"'
        . ' and category.rgt< "'.Yii::app()->params['categories'][$this->category_id]['rgt'].'"'
        . ' and category.root = "'.Yii::app()->params['categories'][$this->category_id]['root'].'")');
                
        if($this->fields) {
            $criteria->addCondition(" t.fields regexp '".$this->fields."' ");
        }
        
        $criteria->join='inner join category on category.id=t.category_id';
        
        $criteria->compare('type', $this->type);
        $criteria->compare('views', $this->views);
        $criteria->compare('text', $this->text, true);
	
	$criteria->order = 'id desc';
        $criteria->limit = Yii::app()->params['adv_on_page'];

        return new CActiveDataProvider($this, array(
                'criteria' => $criteria,
            ));
    }
    
    public function scopes()
    {
        return array(
            'sitemap'=>array('select'=>'id', 'condition'=>'created_at <= NOW()', 'order'=>'created_at ASC'),
        );
    }

    public function behaviors()
    {
        return array(
            'CTimestampBehavior' => array(
                'class' => 'zii.behaviors.CTimestampBehavior',
                'createAttribute' => 'created_at',
                'updateAttribute' => 'updated_at',
            ),
            'galleryBehavior' => array(
                'class' => 'GalleryBehavior',
                'idAttribute' => 'gallery_id',
                'versions' => array(
                    'small' => array(
                        'centeredpreview' => array(98, 98),
                    ),
                    'medium' => array(
                        'resize' => array(800, null),
                    )
                ),
                'name' => false,
                'description' => false,
            )
        );
    }

    /**
     * return first GalleryPhoto
     * @return GalleryPhoto
     */
    public function getPhoto()
    {
        if ($this->gallery && $this->gallery->galleryPhotos)
        {

            if (!empty($this->gallery->galleryPhotos[0]))
                return $this->gallery->galleryPhotos[0];
        }
    }

}