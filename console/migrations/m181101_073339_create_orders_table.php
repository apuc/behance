<?php

use yii\db\Migration;

/**
 * Handles the creation of table `orders`.
 */
class m181101_073339_create_orders_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('orders', [
            'id' => $this->primaryKey()->unsigned(),
	        'accounts_id' => $this->integer()->unsigned(),
	        'cases_id' => $this->integer()->unsigned(),
            'status' => $this->tinyInteger(3)->unsigned(),
            'dt_add' => $this->dateTime(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('orders');
    }
}
