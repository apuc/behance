<?php

use yii\db\Migration;

/**
 * Handles adding position to table `cases`.
 */
class m181115_101918_add_position_column_to_cases_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('cases', 'img', $this->text());
        $this->addColumn('cases', 'status', $this->tinyInteger(3)->unsigned());
        $this->addColumn('cases', 'price', $this->decimal(8,2)->unsigned());
        $this->addColumn('cases', 'term', $this->string());
	    $this->dropColumn('cases', 'behance_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('cases', 'img');
        $this->dropColumn('cases', 'status');
        $this->dropColumn('cases', 'price');
        $this->dropColumn('cases', 'term');
        $this->addColumn('cases', 'behance_id', $this->integer()->unsigned());
    }
}
