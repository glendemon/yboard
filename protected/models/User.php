<?php

class User extends CActiveRecord {

    const STATUS_NOACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_BANNED = -1;
    //TODO: Delete for next version (backward compatibility)
    const STATUS_BANED = -1;
    
    public $full_name;
    public $skype;

    /**
     * The followings are the available columns in table 'users':
     * @var integer $id
     * @var string $username
     * @var string $password
     * @var string $email
     * @var string $activkey
     * @var integer $createtime
     * @var integer $lastvisit
     * @var integer $superuser
     * @var integer $status
     * @var timestamp $create_at
     * @var timestamp $lastvisit_at
     */

    /**
     * Returns the static model of the specified AR class.
     * @return CActiveRecord the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return "users";
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.CConsoleApplication
        /*
        return ((get_class(Yii::app()) == 'CConsoleApplication' ||  && UserModule::isAdmin())) ? array(
                    array('username', 'length', 'max' => 20, 'min' => 3,
                        'message' => t("Incorrect username (length between 3 and 20 characters).")),
                    array('password', 'length', 'max' => 128, 'min' => 4,
                        'message' => t("Incorrect password (minimal length 4 symbols).")),
                    array('email', 'email'),
                    array('username', 'unique', 'message' => t("This user's name already exists.")),
                    array('email', 'unique', 'message' => t("This user's email address already exists.")),
                    //array('username', 'match', 'pattern' => '/^[A-Za-z0-9_]+$/u','message' => t("Incorrect symbols (A-z0-9).")),
                    array('status', 'in', 'range' => array(self::STATUS_NOACTIVE, self::STATUS_ACTIVE, self::STATUS_BANNED)),
                    array('superuser', 'in', 'range' => array(0, 1)),
                    array('create_at', 'default', 'value' => date('Y-m-d H:i:s'),
                        'setOnEmpty' => true, 'on' => 'insert'),
                    array('lastvisit_at', 'default', 'value' => '0000-00-00 00:00:00',
                        'setOnEmpty' => true, 'on' => 'insert'),
                    array('username, email, superuser, status', 'required'),
                    array('superuser, status', 'numerical', 'integerOnly' => true),
                    array('id, username, password, email, activkey, '
                        . 'create_at, birthday, location, phone, skype, '
                        . 'contacts, lastvisit_at, superuser, status', 'safe', 'on' => 'search'),
                        ) : ((Yii::app()->user->id == $this->id) ? array(
                            array('username, email', 'required'),
                            array('username', 'length', 'max' => 20, 'min' => 3, 'message' => t("Incorrect username (length between 3 and 20 characters).")),
                            array('email', 'email'),
                            array('username', 'unique', 'message' => t("This user's name already exists.")),
                            //array('username', 'match', 'pattern' => '/^[A-Za-z0-9_]+$/u','message' => t("Incorrect symbols (A-z0-9).")),
                            array('email', 'unique', 'message' => t("This user's email address already exists.")),
                                ) : array(array('id, username, password, email, activkey, '
                                . 'create_at, birthday, location, phone, skype, '
                                . 'contacts, lastvisit_at, superuser, status', 'safe', 'on' => 'search'))));
         * 
         */
        
        return array(
            array('username', 'length', 'max' => 20, 'min' => 3,
                'message' => t("Incorrect username (length between 3 and 20 characters).")),
            array('password', 'length', 'max' => 128, 'min' => 4,
                'message' => t("Incorrect password (minimal length 4 symbols).")),
            array('email', 'email'),
            array('username', 'unique', 'message' => t("This user's name already exists.")),
            array('email', 'unique', 'message' => t("This user's email address already exists.")),
            //array('username', 'match', 'pattern' => '/^[A-Za-z0-9_]+$/u','message' => t("Incorrect symbols (A-z0-9).")),
            array('status', 'in', 'range' => array(self::STATUS_NOACTIVE, self::STATUS_ACTIVE, self::STATUS_BANNED)),
            array('superuser', 'in', 'range' => array(0, 1)),
            array('create_at', 'default', 'value' => date('Y-m-d H:i:s'),
                'setOnEmpty' => true, 'on' => 'insert'),
            array('lastvisit_at', 'default', 'value' => date('Y-m-d H:i:s'),
                'setOnEmpty' => true, 'on' => 'insert'),
            array('username, email, superuser, status', 'required'),
            array('superuser, status', 'numerical', 'integerOnly' => true),
            array('id, username, password, email, activkey, '
                . 'create_at, birthday, location, phone, skype, '
                . 'contacts, lastvisit_at, superuser, status', 'safe', 'on'=>'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        /*
          $relations = Yii::app()->getModule('user')->relations;
          if (!isset($relations['profile']))
          $relations['profile'] = array(self::HAS_ONE, 'Profile', 'user_id');
          return $relations;
         * 
         */
        return array();
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => t("Id"),
            'username' => t("username"),
            'password' => t("password"),
            'verifyPassword' => t("Retype Password"),
            'email' => t("E-mail"),
            'verifyCode' => t("Verification Code"),
            'activkey' => t("activation key"),
            'createtime' => t("Registration date"),
            'create_at' => t("Registration date"),
            'lastvisit_at' => t("Last visit"),
            'superuser' => t("Superuser"),
            'status' => t("Status"),
            'full_name' => t("Full name"),
            'phone' => t("phone"),
            'birthday' => t("birthday"),
            'contacts' => t("Contacts"),
        );
    }

    public function scopes() {
        return array(
            'active' => array(
                'condition' => 'status=' . self::STATUS_ACTIVE,
            ),
            'notactive' => array(
                'condition' => 'status=' . self::STATUS_NOACTIVE,
            ),
            'banned' => array(
                'condition' => 'status=' . self::STATUS_BANNED,
            ),
            'superuser' => array(
                'condition' => 'superuser=1',
            ),
            'notsafe' => array(
                'select' => 'id, username, password, email, activkey, create_at, lastvisit_at, superuser, status',
            ),
        );
    }

    public function defaultScope() {
        return CMap::mergeArray(Yii::app()->getModule('user')->defaultScope, 
            array(
            'alias' => 'user',
        ));
    }

    public static function itemAlias($type, $code = NULL) {
        $_items = array(
            'UserStatus' => array(
                self::STATUS_NOACTIVE => t('Not active'),
                self::STATUS_ACTIVE => t('Active'),
                self::STATUS_BANNED => t('Banned'),
            ),
            'AdminStatus' => array(
                '0' => t('No'),
                '1' => t('Yes'),
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
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('username', $this->username, true);
        $criteria->compare('password', $this->password);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('activkey', $this->activkey);
        $criteria->compare('create_at', $this->create_at);
        $criteria->compare('lastvisit_at', $this->lastvisit_at);
        $criteria->compare('superuser', $this->superuser);
        $criteria->compare('status', $this->status);

        return new CActiveDataProvider(get_class($this), array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => Yii::app()->getModule('user')->user_page_size,
            ),
        ));
    }

    public function getCreatetime() {
        return strtotime($this->create_at);
    }

    public function setCreatetime($value) {
        $this->create_at = date('Y-m-d H:i:s', $value);
    }

    public function getLastvisit() {
        return strtotime($this->lastvisit_at);
    }

    public function setLastvisit($value) {
        $this->lastvisit_at = date('Y-m-d H:i:s', $value);
    }

}
