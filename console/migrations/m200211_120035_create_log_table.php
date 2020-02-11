<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%log}}`.
 */
class m200211_120035_create_log_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%log}}', [
            'id' => $this->primaryKey(),
            'date' => $this->dateTime(),
            'log_text' => $this->text()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%log}}');
    }
}
