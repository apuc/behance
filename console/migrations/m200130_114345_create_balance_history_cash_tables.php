<?php

use yii\db\Migration;

/**
 * Class m200130_114345_create_balance_history_cash_tables
 */
class m200130_114345_create_balance_history_cash_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('balance_cash', [
            'id' => $this->primaryKey()->unsigned(),
            'user_id' => $this->integer()->unsigned(),
            'amount' => $this->bigInteger()->unsigned()
        ]);
        $this->createTable('history_cash', [
            'id' => $this->primaryKey()->unsigned(),
            'type' => $this->string('255'),
            'description' => $this->text(),
            'user_id' => $this->integer()->unsigned(),
            'dt_add' => $this->dateTime(),
            'amount' => $this->bigInteger()->unsigned()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('balance_cash');
        $this->dropTable('history_cash');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200130_114345_create_balance_history_cash_tables cannot be reverted.\n";

        return false;
    }
    */
}
