<?php

/**
 * This is the model class for table "advertisement".
 *
 * The followings are the available columns in table 'advertisement':
 * @property integer $id
 * @property string $banner
 * @property string $url
 * @property string $name
 * @property string $description
 * @property integer $order
 * @property integer $gallery_id
 * @property string $extra
 */
class Advertisement extends CActiveRecord
{
    /**
     * @var string directory in web root for banners
     * @example images/banners/
     */
    public $bannersDir = 'images/banners/';

    public $email;
    public $phone;
    public $contact;
    public $youtube;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Advertisement the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'advertisement';
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
			array('order, gallery_id', 'numerical', 'integerOnly'=>true),
			array('url, name, email, phone, contact', 'length', 'max'=>255),
			array('description, extra', 'safe'),
            array('banner', 'file', 'types'=>'jpeg,jpg,gif,png', 'on'=>'create'),
            array('banner', 'file', 'types'=>'jpeg,jpg,gif,png', 'allowEmpty' => true, 'on'=>'update'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, banner, url, name, description, order, gallery_id, extra', 'safe', 'on'=>'search'),
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
            'gallery' => array(self::BELONGS_TO, 'Gallery', 'gallery_id'),
		);
	}

    public function behaviors()
    {
        return array(
            'CSerializeBehavior' => array(
                'class' => 'application.behaviors.CSerializeBehavior',
                'serialAttributes' => array('extra'), // name of attribute(s)
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
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('main', 'ID'),
			'banner' => Yii::t('main', 'Banner'),
			'url' => Yii::t('main', 'Url'),
			'name' => Yii::t('main', 'Name'),
			'description' => Yii::t('main', 'Description'),
			'order' => Yii::t('main', 'Order'),
			'gallery_id' => Yii::t('main', 'Gallery'),
			'extra' => Yii::t('main', 'Extra'),
            'youtube' => Yii::t('main', 'Youtube'),
            'email' => Yii::t('main', 'Email'),
            'phone' => Yii::t('main', 'Phone'),
            'contact' => Yii::t('main', 'Contact'),
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

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('banner',$this->banner,true);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('order',$this->order);
		$criteria->compare('gallery_id',$this->gallery_id);
		$criteria->compare('extra',$this->extra,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    protected function beforeSave()
    {
        $this->extra = array(
            'email' => $this->email,
            'phone' => $this->phone,
            'contact' => $this->contact,
            'youtube' => $this->youtube,
        );

        return parent::beforeSave();
    }

    protected function afterFind()
    {
        parent::afterFind();
        $this->email = $this->getValueFromExtra('email');
        $this->phone = $this->getValueFromExtra('phone');
        $this->contact = $this->getValueFromExtra('contact');
        $this->youtube = $this->getValueFromExtra('youtube');
    }

    public function getBannerUrl()
    {
        if ($this->banner)
            return Yii::app()->request->baseUrl . '/' . $this->bannersDir . $this->banner;
    }

    protected function getValueFromExtra($key)
    {
        return !empty($this->extra[$key])? $this->extra[$key] : '';
    }

}