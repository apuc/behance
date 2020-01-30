<?php

use yii\db\Migration;

/**
 * Class m200130_140645_set_everyone_balance_zero
 */
class m200130_140645_set_everyone_balance_zero extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // todo:"st everyone's balance to 0
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200130_140645_set_everyone_balance_zero cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200130_140645_set_everyone_balance_zero cannot be reverted.\n";

        return false;
    }
    */
}
