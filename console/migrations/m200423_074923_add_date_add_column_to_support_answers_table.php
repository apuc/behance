<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%support_answers}}`.
 */
class m200423_074923_add_date_add_column_to_support_answers_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('support_answers', 'date_add', $this->timestamp());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('support_answers', 'date_add');
    }
}
