<?php

use yii\db\Migration;

/**
 * Class m181112_092231_add_column_to_contact_form_table
 */
class m181112_092231_add_column_to_contact_form_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
      $this->addColumn('contact_form','status',$this->integer()->unsigned());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('contact_form','status');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181112_092231_add_column_to_contact_form_table cannot be reverted.\n";

        return false;
    }
    */
}
