<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%support_questions}}`.
 */
class m200423_073801_add_user_id_column_to_support_questions_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('support_questions', 'user_id', $this->integer());

        $this->addForeignKey('fk-users', 'support_questions', 'user_id', 'user', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-users', 'support_questions');
        $this->dropColumn('support_questions', 'user_id');
    }
}
