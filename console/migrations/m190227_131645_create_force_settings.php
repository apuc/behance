<?php

use yii\db\Migration;

/**
 * Class m190227_131645_create_force_settings
 */
class m190227_131645_create_force_settings extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('settings',['key'=>'is_force_enabled','value'=>0]);
        $this->insert('settings',['key'=>'force_max','value'=>3]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190227_131645_create_force_settings cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190227_131645_create_force_settings cannot be reverted.\n";

        return false;
    }
    */
}
