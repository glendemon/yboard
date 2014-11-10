<?php

class m130307_194811_add_youtube extends CDbMigration
{
	public function up()
	{
        $this->addColumn('bulletin', 'youtube_id', 'VARCHAR(255)');
	}

	public function down()
	{
        $this->dropColumn('bulletin', 'youtube_id');
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