<? return array (
  'language' => 'ru',
  'name' => 'Yboard 2',
  'theme' => 'yboard',
  'preload' => 
  array (
    0 => 'log',
  ),
  'import' => 
  array (
    0 => 'application.models.*',
    1 => 'application.components.*',
    2 => 'application.modules.admin.*',
    3 => 'application.modules.user.*',
    4 => 'application.modules.user.models.*',
    5 => 'application.modules.user.components.*',
    7 => 'application.extensions.yii-mail.*',
    8 => 'application.extensions.gallerymanager.*',
    9 => 'application.extensions.gallerymanager.models.*',
  ),
  'modules' => 
  array (
    'gii' => 
    array (
      'class' => 'system.gii.GiiModule',
      'password' => 'qwerty',
    ),
    'user' => 
    array (
      'hash' => 'md5',
      'sendActivationMail' => true,
      'loginNotActiv' => false,
      'activeAfterRegister' => false,
      'autoLogin' => true,
      'registrationUrl' => 
      array (
        0 => '/user/registration',
      ),
      'recoveryUrl' => 
      array (
        0 => '/user/recovery',
      ),
      'loginUrl' => 
      array (
        0 => '/user/login',
      ),
      'returnUrl' => 
      array (
        0 => '/user/profile',
      ),
      'returnLogoutUrl' => 
      array (
        0 => '/user/login',
      ),
    ),
    0 => 'admin',
  ),
  'components' => 
  array (
    'user' => 
    array (
      'class' => 'WebUser',
      'allowAutoLogin' => true,
      'loginUrl' => 
      array (
        0 => '/user/login',
      ),
    ),
    'cache' => 
    array (
      'class' => 'system.caching.CFileCache',
    ),
    'Board' => 
    array (
      'class' => 'Board',
    ),
    'evenness' => 
    array (
      'class' => 'Evenness',
    ),
    'bootstrap' => 
    array (
      'class' => 'bootstrap.components.Bootstrap',
    ),
    'image' => 
    array (
      'class' => 'application.extensions.image.CImageComponent',
      'driver' => 'GD',
    ),
    'mail' => 
    array (
      'class' => 'ext.yii-mail.YiiMail',
      'transportType' => 'php',
      'viewPath' => 'themes.views.mail',
    ),
    'email' => 
    array (
      'class' => 'application.extensions.email.Email',
      'delivery' => 'php',
    ),
    'config' => 
    array (
      'class' => 'application.extensions.EConfig',
      'strictMode' => false,
    ),
    'urlManager' => 
    array (
      'urlFormat' => 'path',
      'showScriptName' => false,
      'rules' => 
      array (
        '' => 'site/index',
        '<id:\\d+>' => 'bulletin/view',
        'category/<cat_id:\\d+>' => 'adverts/category',
        'category/<action:\\w+>/' => 'admin/category/<action>',
        '<controller:\\w+>/<id:\\d+>' => '<controller>/view',
        '<controller:\\w+>/<action:\\w+>/<id:\\d+>' => '<controller>/<action>',
        '<controller:\\w+>/<action:\\w+>' => '<controller>/<action>',
      ),
    ),
    'errorHandler' => 
    array (
      'errorAction' => 'site/error',
    ),
    'log' => array(
        'class' => 'CLogRouter',
                    'enabled'=>YII_DEBUG,
        'routes' => array(
            array(
                'class' => 'CFileLogRoute',
                'levels' => 'error, warning',
    //                    'class'=>'ext.yii-debug-toolbar.YiiDebugToolbarRoute',
    //                    'ipFilters'=>array('127.0.0.1','192.168.1.3'),
            ),
                            array(
                                    'class'=>'application.extensions.yii-debug-toolbar.YiiDebugToolbarRoute',
                                    'ipFilters'=>array('127.0.0.1','192.168.1.215'),
                            ),
        // uncomment the following to show log messages on web pages
        /*
          array(
          'class'=>'CWebLogRoute',
          ),
         */
        ),
    ),
    'db' => 
    array (
      'connectionString' => 'mysql:host=localhost;dbname=yboard2',
      'emulatePrepare' => true,
      'username' => 'root',
      'password' => '123456',
      'charset' => 'utf8',
      'tablePrefix' => '',
    ),
  ),
  'params' => 
  array (
    'adminEmail' => 'mazer@mail.ru',
    'installed' => 'no',
  ),
) ?>