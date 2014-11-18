<?php

/**
 * This is the model class for table "bulletin".
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
class Bulletin extends CActiveRecord
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
        return 'bulletin';
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
            array('user_id, category_id, gallery_id views', 'numerical', 'integerOnly' => true),
            array('name', 'length', 'max' => 255),
            array('type', 'safe'),
            array('created_at, updated_at', 'default', 'setOnEmpty'=>true, 'value'=>null),
            array('youtube_id', 'file', 'types'=>'mov, mpeg4, avi, wmv, mpegps, flv, 3gpp, webm', 'allowEmpty' => true),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, name, user_id, category_id, type, views, text', 'safe', 'on' => 'search'),
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
            'id' => Yii::t('bulletin', 'ID'),
            'name' => Yii::t('bulletin', 'Name'),
            'user_id' => Yii::t('bulletin', 'User'),
            'category_id' => Yii::t('bulletin', 'Category'),
            'type' => Yii::t('bulletin', 'Type'),
            'views' => Yii::t('bulletin', 'Views'),
            'text' => Yii::t('bulletin', 'Text'),
            'gallery_id' => Yii::t('bulletin', 'Gallery'),
            'youtube_id' => Yii::t('bulletin', 'Youtube'),
            'created_at' => Yii::t('bulletin', 'Created At'),
            'updated_at' => Yii::t('bulletin', 'Updated At'),
        );
    }

    public static function itemAlias($type, $code = NULL)
    {
        $_items = array(
            'type' => array(
                self::TYPE_DEMAND => Yii::t('bulletin', 'Demand'),
                self::TYPE_OFFER => Yii::t('bulletin', 'Offer'),
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
        $criteria->compare('category_id', $this->category_id);
        $criteria->compare('type', $this->type);
        $criteria->compare('views', $this->views);
        $criteria->compare('text', $this->text, true);

        return new CActiveDataProvider($this, array(
                'criteria' => $criteria,
            ));
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