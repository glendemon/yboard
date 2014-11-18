<?php

class m130306_134530_add_gallery_id_to_bulletin extends CDbMigration
{
	public function up()
	{
        $this->addColumn('bulletin', 'gallery_id', 'INTEGER');
	}

	public function down()
	{
        $this->dropColumn('bulletin', 'gallery_id');
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