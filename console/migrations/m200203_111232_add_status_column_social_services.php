<?php

use yii\db\Migration;

/**
 * Class m200203_111232_add_status_column_social_services
 */
class m200203_111232_add_status_column_social_services extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('socials_services', 'status', $this->boolean());
        $this->update('socials_services', ['status' => 1]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('socials_services', 'status');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200203_111232_add_status_column_social_services cannot be reverted.\n";

        return false;
    }
    */
}
