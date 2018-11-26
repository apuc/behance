<?php

use yii\db\Migration;

/**
 * Handles the creation of table `callback`.
 */
class m181122_122337_create_callback_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('callback', [
            'id' => $this->primaryKey(),
            'phone_number' => $this->string(),
            'dt_add' => $this->string(),
            'status' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('callback');
    }
}
