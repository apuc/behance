<?php

use yii\db\Migration;


/**
 * Class m181203_105944_change_settings_value_type
 */
class m181203_105944_change_settings_value_type extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
       Yii::$app->db->createCommand()->setRawSql('ALTER TABLE `settings` CHANGE `value` `value` TEXT 
       CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL')->execute();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        Yii::$app->db->createCommand()->setRawSql('ALTER TABLE `settings` CHANGE `value` `value` VARCHAR(255) 
         CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL')->execute();
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181203_105944_change_settings_value_type cannot be reverted.\n";

        return false;
    }
    */
}
