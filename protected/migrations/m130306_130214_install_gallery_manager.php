<?php

class m130306_130214_install_gallery_manager extends CDbMigration
{
    /*
     * Put following functions in your migration
     */
    public function up()
    {
        $this->createTable('gallery', array(
            'id' => 'pk',
            'versions_data' => 'text NOT NULL',
            'name' => 'boolean NOT NULL DEFAULT 1',
            'description' => 'boolean NOT NULL DEFAULT 1'
        ));

        $this->createTable('gallery_photo', array(
            'id' => 'pk',
            'gallery_id' => 'integer NOT NULL',
            'rank' => 'integer NOT NULL DEFAULT 0',
            'name' => 'string NOT NULL',
            'description' => 'text',
            'file_name' => 'string NOT NULL'
        ));
    }

    public function down()
    {
        $this->dropTable('gallery_photo');
        $this->dropTable('gallery');
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