<?php

use yii\db\Migration;

/**
 * Handles the creation of table `proxy`.
 */
class m181015_083924_create_proxy_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('proxy', [
            'id' => $this->primaryKey(),
            'ip' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('proxy');
    }
}
