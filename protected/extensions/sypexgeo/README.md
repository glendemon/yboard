SypexGeo extension for Yii2 
============================
Yii2 extension for Sypex Geo API

Sypex Geo - product for location by IP address.
Obtaining the IP address, Sypex Geo outputs information about the location of the visitor - country, region, city,
geographical coordinates and other in Russian and in English.
Sypex Geo use local compact binary database file and works very quickly.
For more information visit: http://sypexgeo.net/

This Yii2 extension allow use Sypex Geo API in Yii2 application.

Usage
-----

Once the extension is installed, simply use it in your code by  :

```php
<?php
    $geo = new \jisoft\sypexgeo\Sypexgeo();

    // get by remote IP
    $geo->get();                // also returned geo data as array
    echo $geo->ip,'<br>';
    echo $geo->ipAsLong,'<br>';
    var_dump($geo->country); echo '<br>';
    var_dump($geo->region);  echo '<br>';
    var_dump($geo->city);    echo '<br>';

    // get by custom IP
    $geo->get('212.42.76.252');
?>
```
Information about country, region and city returned as array.
For example:
```html

Country
 array (
    'id' => 222,
    'iso' => 'UA',
    'continent' => 'EU',
    'lat' => 49,
    'lon' => 32,
    'name_ru' => 'Украина',
    'name_en' => 'Ukraine',
    'timezone' => 'Europe/Kiev',
  ),

Region
 array (
    'id' => 709716,
    'lat' => 48,
    'lon' => 37.5,
    'name_ru' => 'Донецкая область',
    'name_en' => 'Donets\'ka Oblast\'',
    'iso' => 'UA-14',
    'timezone' => 'Europe/Zaporozhye',
    'okato' => '14',
  ),

City
 array (
    'id' => 709717,
    'lat' => 48.023000000000003,
    'lon' => 37.802239999999998,
    'name_ru' => 'Донецк',
    'name_en' => 'Donets\'k',
    'okato' => '14101',
  ),

```

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist jisoft/yii2-sypexgeo "*"
```

or add

```
"jisoft/yii2-sypexgeo": "*"
```

to the require section of your `composer.json` file.

