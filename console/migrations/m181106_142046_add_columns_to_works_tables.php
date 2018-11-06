<?php

use yii\db\Migration;

/**
 * Class m181106_142046_add_columns_to_works_tables
 */
class m181106_142046_add_columns_to_works_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
      $this->addColumn('works','start_likes',$this->integer()->unsigned());
      $this->addColumn('works','start_views',$this->integer()->unsigned());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('works','start_likes');
        $this->dropColumn('works','start_views');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181106_142046_add_columns_to_works_tables cannot be reverted.\n";

        return false;
    }
    */
}
