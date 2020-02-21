<?php

use yii\db\Migration;

/**
 * Class m200220_131522_add_api_key_setting
 */
class m200220_131522_add_api_key_setting extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('settings', ['key' => 'api_key', 'value' => 'e94580eb-08eb-4e0e-9dc8-48d30ed67c3d']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200220_131522_add_api_key_setting cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200220_131522_add_api_key_setting cannot be reverted.\n";

        return false;
    }
    */
}
