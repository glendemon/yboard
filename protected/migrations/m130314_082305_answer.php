<?php

class m130314_082305_answer extends CDbMigration
{
    public function up()
    {
        $this->createTable('answer', array(
            'id' => 'pk',
            'parent_id' => 'INTEGER',
            'user_id' => 'INTEGER',
            'text' => 'text NOT NULL',
            'created_at' => 'TIMESTAMP',
            'updated_at' => 'TIMESTAMP',
        ));
    }

    public function down()
    {
        $this->dropTable('answer');
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