<?php

class m130306_101809_add_timestamp_behavior extends CDbMigration
{
	public function up()
	{
        $this->addColumn('bulletin', 'created_at', 'INTEGER');
        $this->addColumn('bulletin', 'updated_at', 'INTEGER');
	}

	public function down()
	{
        $this->dropColumn('bulletin', 'created_at');
        $this->dropColumn('bulletin', 'updated_at');
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