<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%support_answers}}`.
 */
class m200421_122744_create_support_answers_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%support_answers}}', [
            'id' => $this->primaryKey(),
            'question_id' => $this->integer(),
            'text' => $this->text(),
            'status' => $this->tinyInteger(),
        ]);
        $this->addForeignKey('fk-support_questions', 'support_answers', 'question_id', 'support_questions', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-support_questions', 'support_answers');
        $this->dropTable('{{%support_answers}}');
    }
}
