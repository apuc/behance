<?php

use yii\db\Migration;

/**
 * Class m181106_070522_add_user_id_colums_to_accounts_table
 */
class m181106_070522_add_user_id_colums_to_accounts_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
      $this->addColumn('accounts','user_id',$this->integer()->unsigned());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('accounts','user_id');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181106_070522_add_user_id_colums_to_accounts_table cannot be reverted.\n";

        return false;
    }
    */
}
