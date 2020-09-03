<?php

use yii\db\Migration;

/**
 * Handles adding position to table `history`.
 */
class m181112_135958_add_position_column_to_history_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
	    $this->addColumn('history', 'likes', $this->integer()->unsigned());
	    $this->addColumn('history', 'views', $this->integer()->unsigned());
	    $this->renameColumn('history', 'name', 'type');
	    $this->renameColumn('history', 'accounts_id', 'user_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('history', 'position');
    }
}
