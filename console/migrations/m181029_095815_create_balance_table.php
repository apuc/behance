<?php

use yii\db\Migration;

/**
 * Handles the creation of table `balance`.
 */
class m181029_095815_create_balance_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('balance', [
            'id' => $this->primaryKey()->unsigned(),
	        'user_id' => $this->integer()->unsigned(),
	        'views' => $this->integer()->unsigned(),
	        'likes' => $this->integer()->unsigned(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('balance');
    }
}
