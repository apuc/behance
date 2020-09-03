<?php

use yii\db\Migration;

/**
 * Class m200421_064449_add_quantity_and_sum_value_to_social_queue_table
 */
class m200421_064449_add_quantity_and_sum_value_to_social_queue_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('social_queue', 'quantity', $this->string(50));
        $this->addColumn('social_queue', 'sum', $this->string(50));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('social_queue', 'quantity');
        $this->dropColumn('social_queue', 'sum');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200421_064449_add_quantity_and_sum_value_to_social_queue_table cannot be reverted.\n";

        return false;
    }
    */
}
