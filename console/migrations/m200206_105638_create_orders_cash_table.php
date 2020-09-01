<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%orders_cash}}`.
 */
class m200206_105638_create_orders_cash_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('orders_cash', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(11),
            'order_id' => $this->string()->unique(),
            'amount' => $this->integer(),
            'usd' => $this->string(),
            'date' => $this->dateTime(),
            'is_paid' => $this->boolean()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('orders_cash');
    }
}
