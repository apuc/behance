<?php

use yii\db\Migration;

/**
 * Class m200131_110945_create_social_work
 */
class m200131_110945_create_social_work extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('social_work', [
            'id' => $this->primaryKey()->unsigned(),
            'user_id' => $this->integer()->unsigned(),
            'link_id' => $this->integer()->unsigned(),
            'type_id' => $this->integer()->unsigned(),
            'dt_add' => $this->dateTime(),
            'status' => $this->boolean()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('social_work');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200131_110945_create_social_work cannot be reverted.\n";

        return false;
    }
    */
}
