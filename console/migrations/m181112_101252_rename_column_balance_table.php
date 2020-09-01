<?php

use yii\db\Migration;

/**
 * Class m181112_101252_rename_column_balance_table
 */
class m181112_101252_rename_column_balance_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
      $this->renameColumn('balance','accounts_id','user_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->renameColumn('balance','user_id','accounts_id');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181112_101252_rename_column_balance_table cannot be reverted.\n";

        return false;
    }
    */
}
