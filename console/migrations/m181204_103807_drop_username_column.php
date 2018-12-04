<?php

use yii\db\Migration;

/**
 * Class m181204_103807_drop_username_column
 */
class m181204_103807_drop_username_column extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
       $this->dropColumn('user','username');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn('user','username',$this->string());
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181204_103807_drop_username_column cannot be reverted.\n";

        return false;
    }
    */
}
