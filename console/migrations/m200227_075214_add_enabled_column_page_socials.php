<?php

use yii\db\Migration;

/**
 * Class m200227_075214_add_status_column_page_socials
 */
class m200227_075214_add_enabled_column_page_socials extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('page_socials', 'enabled', $this->boolean());
        $this->addColumn('page_socials_services', 'enabled', $this->boolean());
        $this->update('page_socials', ['enabled' => 1]);
        $this->update('page_socials_services', ['enabled' => 1]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('page_socials', 'status');
        $this->dropColumn('page_socials_services', 'status');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200227_075214_add_status_column_page_socials cannot be reverted.\n";

        return false;
    }
    */
}
