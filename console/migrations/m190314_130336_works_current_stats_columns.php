<?php

use yii\db\Migration;

/**
 * Class m190314_130336_works_current_stats_columns
 */
class m190314_130336_works_current_stats_columns extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
       $this->addColumn('works','current_likes',$this->integer());
       $this->addColumn('works','current_views',$this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('works','current_likes');
        $this->dropColumn('works','current_views');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190314_130336_works_current_stats_columns cannot be reverted.\n";

        return false;
    }
    */
}
