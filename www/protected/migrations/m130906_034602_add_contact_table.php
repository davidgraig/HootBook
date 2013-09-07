<?php

class m130906_034602_add_contact_table extends CDbMigration
{
	public function up()
	{
        $this->createTable('contact', array(
            'id' => 'pk',
            'user_id' => 'integer NOT NULL',
            'first_name' => 'string NOT NULL',
            'last_name' => 'string NOT NULL',
            'phone' => 'integer NOT NULL',
            'twitter' => 'string NOT NULL',
            'favorite' => 'boolean NOT NULL DEFAULT 0',
            'created_at' => 'DATETIME NOT NULL',
        ));
        $this->addForeignKey('user_contact_fk', 'contact', 'user_id', 'user', 'id', 'CASCADE', 'CASCADE');
	}

	public function down()
	{
		$this->dropTable('contact');
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