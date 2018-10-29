<?php

use yii\db\Migration;

/**
 * Handles adding position to table `queue`.
 */
class m181029_123336_add_position_column_to_queue_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('queue', 'views_count', $this->integer()->unsigned());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('queue', 'views_count');
    }
}
