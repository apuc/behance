<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%youtube_queue}}`.
 */
class m190821_140016_create_youtube_queue_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%youtube_queue}}', [
            'id' => $this->primaryKey(),
            'url' => $this->string(255)->notNull(),
            'views' => $this->integer(11)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%youtube_queue}}');
    }
}
