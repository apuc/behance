<?php

use yii\db\Migration;

/**
 * Handles the creation of table `cases`.
 */
class m181031_115835_create_cases_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('cases', [
            'id' => $this->primaryKey()->unsigned(),
	        'behance_id' => $this->integer()->unsigned(),
	        'views' => $this->integer()->unsigned(),
	        'likes' => $this->integer()->unsigned(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('cases');
    }
}
