<? 
 return array (
  'meta' => //Основные мета данные [hidden]
  array (
    'title' => 'Категория "<cat_name>". Бесплатная доска объявлений <site_name> . Страница <page_number>',
    'description' => 'Доска объявлений. <cat_name> купить продать. Объявление <adv_name>.',
    'keywords' => 'объявления, купить, продать',
  ),
  'adv_meta' => //Основные мета данные [hidden]//Мета данные для вывода объявления [hidden]
  array (
    'title' => 'Доска объявлений. <cat_name> купить продать. Объявление <adv_name>.',
    'description' => 'Доска объявлений. <cat_name> купить продать. Объявление <adv_name>.',
    'keywords' => 'объявления, купить, продать',
  ),
  'moder_type' => '0',//Тип модерации:  [options|0(постмодерация)|1(премодерация)]
  'stop_words' => //Список запрещеных слов [dinamic] [hidden]
  array (
    0 => 'секс',
    1 => 'сигарет',
    2 => 'курен',
    3 => 'алко',
    4 => 'курит',
    5 => 'наркот',
  ),
  'fileds_type' => 
  array (
    0 => 'text',
    1 => 'checkbox',
    2 => 'select',
  ),
  'adv_on_page' => '10',//Количество объявлений на странице
  'currency' => //Валюты  [hidden]
  array (
    0 => 'USD',
    1 => 'RUB',
    2 => 'EURO',
  ),
  'exchange' => //Курсы валют [hidden]
  array (
    0 => '1',
    1 => '56.58',
    2 => '0.91',
  ),
  'no_price_cats' => //Категории без поля "цена" [dinamic] [hidden]
  array (
    0 => '3',
  ),
  'no_type_cats' => //Категории без значения (спрос/предложение) [dinamic] [hidden]
  array (
    0 => '4',
  ),
  'adminEmail' => 'admin@yboard.org',//Емайл администрации
) 
 ?>