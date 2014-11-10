<?php

class m130313_071213_advertisement extends CDbMigration
{
    public function up()
    {
        $this->createTable('advertisement', array(
            'id' => 'pk',
            'banner' => 'VARCHAR(255) NOT NULL',
            'url' => 'VARCHAR(255)',
            'name' => "VARCHAR(255) NOT NULL",
            'description' => 'text',
            'order' => 'INTEGER',
            'gallery_id' => 'INTEGER',
            'extra' => 'text',
        ));
    }

    public function down()
    {
        $this->dropTable('advertisement');
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