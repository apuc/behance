<?php

use yii\db\Migration;

/**
 * Class m190314_133828_queue_static_stats
 */
class m190314_133828_queue_static_stats extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
       $this->addColumn('queue','likes',$this->integer());
       $this->addColumn('queue','views',$this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('queue','likes');
        $this->dropColumn('queue','views');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190314_133828_queue_static_stats cannot be reverted.\n";

        return false;
    }
    */
}
