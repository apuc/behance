<?php

use yii\db\Migration;

/**
 * Handles adding position to table `cases`.
 */
class m181101_085728_add_position_column_to_cases_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
    	$this->addColumn('cases', 'name', $this->string(255));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
	    $this->dropColumn('cases', 'name');
    }
}
