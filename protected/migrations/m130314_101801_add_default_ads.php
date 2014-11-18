<?php

class m130314_101801_add_default_ads extends CDbMigration
{
	public function up()
	{
        $ads = array(
            array(
                "id" => 1,
                "name" => "Звериная дача",
                "banner" => "fishleft2.jpg",
                "url" => "http://www.zverinaia-dacha.ru/",
                "order" => 1,
            ),
            array(
                "id" => 2,
                "name" => "EARAZA",
                "banner" => "EARAZA.jpg",
                "url" => "http://earaza.ru/",
                "order" => 2,
            ),
            array(
                "id" => 3,
                "name" => "Место для вашей рекламы",
                "banner" => "13.jpg",
                "order" => 3,
            ),
            array(
                "id" => 4,
                "name" => "Место для вашей рекламы",
                "banner" => "fish1.jpg",
                "order" => 4,
            ),
            array(
                "id" => 5,
                "name" => "animalsimport",
                "banner" => "animal.gif",
                "url" => "http://animalsimport.ru/",
                "order" => 5,
            ),
            array(
                "id" => 6,
                "name" => "superiorcats",
                "banner" => "banner120x700.gif",
                "url" => "http://www.superiorcats.com/ru/",
                "order" => 6,
            ),
            array(
                "id" => 7,
                "name" => "Место для вашей рекламы",
                "banner" => "fish1_2.jpg",
                "order" => 7,
            ),
        );
        foreach ($ads as $ad)
        {
            $this->insert('advertisement',$ad);
        }
	}

	public function down()
	{
        $this->delete('advertisement', 'id<=:id', array(':id'=>7));
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}