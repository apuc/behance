<?php

use yii\db\Migration;

/**
 * Class m200206_100507_add_settings_to_settings
 */
class m200206_100507_add_settings_to_settings extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('settings', ['key' => 'add_coeff', 'value' => '1.1']);
        $this->insert('settings', ['key' => 'exchange_rate_usd', 'value' => '63.1742']);
        $this->insert('settings', ['key' => 'balance_exponent', 'value' => '1000000']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200206_100507_add_settings_to_settings cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200206_100507_add_settings_to_settings cannot be reverted.\n";

        return false;
    }
    */
}
