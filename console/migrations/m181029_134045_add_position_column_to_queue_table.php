<?php

use yii\db\Migration;

/**
 * Handles adding position to table `queue`.
 */
class m181029_134045_add_position_column_to_queue_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('queue', 'account_views', $this->integer()->unsigned());
        $this->renameColumn('queue', 'likes_count', 'likes_work');
        $this->renameColumn('queue', 'views_count', 'views_work');
    }

	
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('queue', 'account_views');
    }
}
