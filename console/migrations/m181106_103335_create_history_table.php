<?php

use yii\db\Migration;

/**
 * Handles the creation of table `history`.
 */
class m181106_103335_create_history_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('history', [
            'id' => $this->primaryKey()->unsigned(),
	        'name' => $this->string('255'),
	        'description' => $this->text(),
	        'accounts_id' => $this->integer()->unsigned(),
	        'dt_add' => $this->dateTime()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('history');
    }
}
