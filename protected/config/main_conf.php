<? return array (
  'basePath' => 'D:\\xampp\\htdocs\\Yboard\\protected\\config\\..',
  'language' => 'ru',
  'name' => 'Доска объявлений',
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
    6 => 'application.extensions.*',
    7 => 'application.extensions.yii-mail.*',
    11 => 'application.extensions.configer.*',
    8 => 'application.extensions.gallerymanager.*',
    9 => 'application.extensions.gallerymanager.models.*',
    10 => 'application.extensions.nestedset.*',
  ),
  'modules' => 
  array (
    'gii' => 
    array (
      'class' => 'system.gii.GiiModule',
      'password' => 'qwerty',
    ),
    0 => 'admin',
    1 => 'cms',
  ),
  'components' => 
  array (
    'user' => 
    array (
      'class' => 'WebUser',
      'allowAutoLogin' => true,
      'loginUrl' => 
      array (
        0 => '/login',
      ),
    ),
    'cache' => 
    array (
      'class' => 'system.caching.CFileCache',
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
        'sitemap.xml' => 'site/sitemapxml',
        '<id:\\d+>' => 'adverts/view/id/<id>',
        'category/<cat_id:\\d+>' => 'adverts/category',
        'logout' => 'login/logout',
        '/banner_edit' => '/admin/banners/edit',
        '/banner_show' => '/admin/banners/show',
        'site/category/<cat_id:\\d+>' => 'adverts/category/cat_id/<cat_id>',
        'cat_fields/<cat_id:\\d+>' => 'adverts/getfields/cat_id/<cat_id>',
        'admin/moderate/<adv_id:\\d+>' => 'admin/adverts/moderate/id/<adv_id>',
        'category/<action:\\w+>/' => 'admin/category/<action>',
        'user/<user_id:\\d+>/' => 'user/view/id/<user_id>',
        '<controller:\\w+>/<id:\\d+>' => '<controller>/view',
        '<controller:\\w+>/<action:\\w+>/<id:\\d+>' => '<controller>/<action>',
        '<controller:\\w+>/<action:\\w+>' => '<controller>/<action>',
      ),
    ),
    'db' => 
    array (
      'connectionString' => 'mysql:host=localhost;dbname=yboard',
      'emulatePrepare' => true,
      'username' => 'root',
      'password' => '123456',
      'charset' => 'utf8',
      'tablePrefix' => '',
    ),
    'errorHandler' => 
    array (
      'class' => 'application.modules.cms.components.CmsHandler',
    ),
    'log' => 
    array (
      'class' => 'CLogRouter',
      'enabled' => true,
      'routes' => 
      array (
        0 => 
        array (
          'class' => 'CFileLogRoute',
          'levels' => 'error, warning',
        ),
        1 => 
        array (
          'class' => 'application.extensions.yii-debug-toolbar.YiiDebugToolbarRoute',
          'ipFilters' => 
          array (
            0 => '*',
          ),
        ),
      ),
    ),
  ),
  'params' => require 'settings.php',
) ?>