<?php

class m130907_225310_addTwitterCache extends CDbMigration
{
	public function up()
	{
        $this->createTable('twitter_cache', array(
            'handle' => 'string NOT NULL PRIMARY KEY',
            'followers' => 'int NOT NULL DEFAULT -1',
            'image' => 'string',
            'last_update' => 'int NOT NULL DEFAULT -1',
        ));
	}

	public function down()
	{
		$this->dropTable('twitter_cache');
	}
}