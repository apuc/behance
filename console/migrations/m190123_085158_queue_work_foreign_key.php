<?php

use yii\db\Migration;

/**
 * Class m190123_085158_queue_work_foreign_key
 */
class m190123_085158_queue_work_foreign_key extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createIndex(
            'idx-queue-work_id',
            'queue',
            'work_id'
        );

        $this->addForeignKey(
            'fk-queue-work_id',
            'queue',
            'work_id',
            'works',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190123_085158_queue_work_foreign_key cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190123_085158_queue_work_foreign_key cannot be reverted.\n";

        return false;
    }
    */
}
