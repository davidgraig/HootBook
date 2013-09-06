<?php

class m130906_033817_add_user_table extends CDbMigration
{
	public function up()
	{
        $this->createTable('user', array(
            'id' => 'pk',
            'username' => 'string NOT NULL',
            'name' => 'string NOT NULL',
            'password' => 'string NOT NULL',
            'email' => 'string NOT NULL',
            'created_at' => 'DATETIME NOT NULL',
        ));
	}

	public function down()
	{
		$this->dropTable('user');
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