<?php

use yii\db\Migration;

/**
 * Class m200325_125831_add_ref_likes_views_settings
 */
class m200325_125831_add_ref_likes_views_settings extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('settings', ['key' => 'referal_likes', 'value' => 5]);
        $this->insert('settings', ['key' => 'referal_views', 'value' => 10]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200325_125831_add_ref_likes_views_settings cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200325_125831_add_ref_likes_views_settings cannot be reverted.\n";

        return false;
    }
    */
}
