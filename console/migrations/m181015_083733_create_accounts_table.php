<?php

use yii\db\Migration;

/**
 * Handles the creation of table `accounts`.
 */
class m181015_083733_create_accounts_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('accounts', [
            'id' => $this->primaryKey(),
            'url' => $this->string(),
            'title' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('accounts');
    }
}
