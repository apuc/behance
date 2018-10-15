<?php

use yii\db\Migration;

/**
 * Handles the creation of table `works`.
 */
class m181015_083701_create_works_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('works', [
            'id' => $this->primaryKey(),
            'account_id' => $this->integer(),
            'behance_id' => $this->string(),
            'url' => $this->string(),
            'name' => $this->string(),
            'preview' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('works');
    }
}
