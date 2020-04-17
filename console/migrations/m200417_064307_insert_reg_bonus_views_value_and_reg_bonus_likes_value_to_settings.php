<?php

use yii\db\Migration;

/**
 * Class m200417_064307_insert_reg_bonus_views_value_and_reg_bonus_likes_value_to_settings
 */
class m200417_064307_insert_reg_bonus_views_value_and_reg_bonus_likes_value_to_settings extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        Yii::$app->db->createCommand()->batchInsert('settings', ['key', 'value'], [
            ['reg_bonus_views', '90'],
            ['reg_bonus_likes', '30'],
        ])->execute();

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        Yii::$app->db->createCommand()->delete('settings', ['in', ['key', 'value'], [['reg_bonus_views', 'value'], ['reg_bonus_likes', 'value']]]
        )->execute();
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200417_064307_insert_reg_bonus_views_value_and_reg_bonus_likes_value_to_settings cannot be reverted.\n";

        return false;
    }
    */
}
