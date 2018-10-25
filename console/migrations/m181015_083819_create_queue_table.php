<?php

use yii\db\Migration;

/**
 * Handles the creation of table `queue`.
 */
class m181015_083819_create_queue_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('queue', [
            'id' => $this->primaryKey()->unsigned(),
            'work_id' => $this->integer()->unsigned(),
            'likes_count' => $this->integer()->unsigned(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('queue');
    }
}
