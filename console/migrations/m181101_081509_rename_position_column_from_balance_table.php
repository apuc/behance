<?php

use yii\db\Migration;

/**
 * Class m181101_081509_rename_position_column_from_balance_table
 */
class m181101_081509_rename_position_column_from_balance_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
		$this->renameColumn('balance', 'user_id', 'accounts_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
	    $this->renameColumn('balance', 'accounts_id', 'user_id');
    }
    
}
