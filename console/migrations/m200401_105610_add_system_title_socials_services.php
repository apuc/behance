<?php

use yii\db\Migration;

/**
 * Class m200401_105610_add_system_title_socials_services
 */
class m200401_105610_add_system_title_socials_services extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('socials_services', 'system_title', $this->string(50)->null());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('socials_services', 'system_title');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200401_105610_add_system_title_socials_services cannot be reverted.\n";

        return false;
    }
    */
}
